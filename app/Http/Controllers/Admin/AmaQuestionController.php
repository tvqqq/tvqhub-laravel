<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AmaQuestionRepositoryInterface;
use Illuminate\Http\Request;

class AmaQuestionController extends Controller
{
    /**
     * @var AmaQuestionRepositoryInterface
     */
    protected $repository;

    /**
     * AmaQuestionController constructor.
     * @param AmaQuestionRepositoryInterface $repository
     */
    public function __construct(AmaQuestionRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = $this->repository->getLatestWithTrashed();

        return view('ama.index', compact('data'));
    }
}
