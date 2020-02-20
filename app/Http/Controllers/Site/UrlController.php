<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlCounterRequest;
use App\Http\Requests\UrlRequest;
use App\Jobs\UrlTracking;
use App\Repositories\UrlRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * @var UrlRepositoryInterface
     */
    protected $repository;

    /**
     * UrlController constructor.
     * @param UrlRepositoryInterface $repository
     */
    public function __construct(UrlRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $backend = [
            'domain' => (request()->isSecure() ? 'https://' : 'http://') . 'ly' . config('session.domain')
        ];
        return view('url.site.index', compact('backend'));
    }

    public function create(UrlRequest $request)
    {
        $validated = $request->validated();

        $originUrl = $validated['origin_url'];
        if ($existed = $this->repository->checkOriginLinkExisted($originUrl)) {
            return $this->responseSuccess($existed);
        }

        $shortLink = $this->repository->createShortLink($originUrl);
        $result = $this->repository->create([
            'origin_url' => $originUrl,
            'slug' => $shortLink
        ]);

        return $this->responseSuccess($result);
    }

    public function counter(UrlCounterRequest $request)
    {
        $validated = $request->validated();

        $data = $this->repository->checkShortLinkExisted($validated['slug']);
        if (!$data) {
            return $this->responseNotFound();
        }

        $result = [
            'slug' => $data['slug'],
            'origin_url' => $data['origin_url'],
            'created_at' => Carbon::parse($data['created_at'])->diffForHumans(),
            'updated_at' => Carbon::parse($data['updated_at'])->diffForHumans(),
            'clicks' => count($data['url_details'])
        ];

        return $this->responseSuccess($result);
    }

    public function redirect(string $slug)
    {
        $vueRoute = ['counter'];
        if (in_array($slug, $vueRoute)) {
            return $this->index();
        }

        $data = $this->repository->checkShortLinkExisted($slug);

        if (!$data) {
            return $this->index(); // 404 Not Found
        }

        // Tracking record
        UrlTracking::dispatch($data['id'], request()->getClientIp(), request()->userAgent());

        return response()->redirectTo($data['origin_url']);
    }
}
