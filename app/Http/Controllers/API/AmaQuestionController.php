<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmaQuestionCreate;
use App\Mail\AMAQuestionSent;
use App\Repositories\AmaQuestionRepositoryInterface;
use Illuminate\Support\Facades\Mail;

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

    /**
     * Show anwsered questions on site.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->repository->getLatestAnsweredQuestion();

        $meta['count_no_reply'] = $this->repository->countNoReply();

        return $this->response(['success' => true, 'data' => $data], $meta);
    }

    /**
     * Post a question.
     *
     * @param AmaQuestionCreate $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(AmaQuestionCreate $request)
    {
        $validated = $request->validated();
        $data = $this->repository->create($validated);

        // Send mail notification
        Mail::to(config('tvqhub.mail_admin'))->queue(new AMAQuestionSent($data));

        return $this->response(['success' => true, 'data' => $data]);
    }
}
