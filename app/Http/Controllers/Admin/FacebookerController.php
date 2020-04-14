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
     * FacebookerController constructor.
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
        $result = $this->repository->getFriendsOnLocal(request('search'), request('auto'));
        return $this->response(['success' => true, 'data' => $result]);
    }

    /**
     * Update current friend lists and write log for tracking.
     */
    public function updateFriends()
    {
        $result = $this->repository->getFriends();
        return $this->response($result);
    }

    /**
     * Show logs
     * @return ResponseFactory|Response
     */
    public function logs()
    {
        $result = $this->repository->getLogs(request('skip'));
        return $this->response(['success' => true, 'data' => $result]);
    }

    /**
     * Get timer auto like available for select
     * @return ResponseFactory|Response
     */
    public function timer()
    {
        $result = $this->repository->getTimer();
        array_unshift($result, [
            'value' => null,
            'text' => '---',
            'disabled' => false
        ]);
        return $this->response(['success' => true, 'data' => $result]);
    }

    /**
     * Update timer auto like of friend
     * @return ResponseFactory|Response
     */
    public function updateTimer()
    {
        $result = $this->repository->updateTimer(request('id'), request('timer'));
        return $this->response(['success' => true, 'data' => $result]);
    }
}
