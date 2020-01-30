<?php

namespace App\Repositories;

use App\Models\AmaQuestion;
use App\Repositories\Base\BaseRepository;
use App\Repositories\AmaQuestionRepositoryInterface;

class AmaQuestionRepository extends BaseRepository implements AmaQuestionRepositoryInterface
{
    /**
     * AmaQuestionRepository constructor.
     *
     * @param AmaQuestion $model
     */
    public function __construct(AmaQuestion $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function getLatestWithTrashed()
    {
        return $this->model->latest()->withTrashed()->get();
    }

    /**
     * @inheritDoc
     */
    public function getLatestAnsweredQuestion()
    {
        return $this->model->whereNotNull('answer')->latest()->get();
    }

    /**
     * @inheritDoc
     */
    public function countNoReply()
    {
        return $this->model->whereNull('answer')->count();
    }
}
