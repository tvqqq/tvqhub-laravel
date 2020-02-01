<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\ChinesePlaylistRepositoryInterface;
use Illuminate\Http\Request;

class ChinesePlaylistController extends Controller
{
    /**
     * @var ChinesePlaylistRepositoryInterface
     */
    protected $repository;

    /**
     * AmaQuestionController constructor.
     * @param ChinesePlaylistRepositoryInterface $repository
     */
    public function __construct(ChinesePlaylistRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $playlist = $this->repository->getLatest();

        return $this->responseSuccess($playlist);
    }
}
