<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AmaQuestionRepositoryInterface;
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
    public function __construct(AmaQuestionRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        $a = $this->repository->find(['id' => 1]);
        dd($a);
    }
}
