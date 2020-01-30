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

    }

    public function create(UrlRequest $request)
    {
        $validated = $request->validated();

        $shortLink = $this->repository->createShortLink($validated['origin_url']);
        $result = $this->repository->create([
            'origin_url' => $validated['origin_url'],
            'slug' => $shortLink
        ]);

        // return
    }
}
