<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\BucketListRepositoryInterface;
use Illuminate\Http\Request;

class BucketListController extends Controller
{
    /**
     * @var BucketListRepositoryInterface
     */
    protected $repository;

    /**
     * BucketListController constructor.
     * @param BucketListRepositoryInterface $repository
     */
    public function __construct(BucketListRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = $this->repository->getAll(false);

        return $this->response(['success' => true, 'data' => $data]);
    }
}
