<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlRequest;
use App\Repositories\UrlRepositoryInterface;
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
        return view('url.site.index');
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
}
