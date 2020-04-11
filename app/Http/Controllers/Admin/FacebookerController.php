<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\FacebookerRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FacebookerController extends Controller
{
    /**
     * @var FacebookerRepositoryInterface
     */
    protected $repository;

    /**
     * ChinesePlaylistController constructor.
     * @param FacebookerRepositoryInterface $repository
     */
    public function __construct(FacebookerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Facebooker Index
     * @return Factory|View
     */
    public function index()
    {
        $backend = [];

        return view('facebooker.index', compact('backend'));
    }

    /**
     * Get friend list to show in pagination
     * @return ResponseFactory|Response
     */
    public function friends()
    {
        $friends = $this->repository->getFriendsOnLocal(request('search'));
        return $this->responseSuccess($friends);
    }

    /**
     * Update current friend lists and write log for tracking.
     */
    public function updateFriends()
    {
        $result = $this->repository->getFriends();
        return $this->responseSuccess($result, null);
    }

    /**
     * Show logs
     * @return ResponseFactory|Response
     */
    public function logs()
    {
        $result = $this->repository->getLogs(request('skip'));
        return $this->responseSuccess($result, null);
    }
}
