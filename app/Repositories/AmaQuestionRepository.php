<?php

namespace App\Repositories;

use App\Models\AmaQuestion;
use App\Repositories\Base\BaseRepository;
use App\Repositories\AmaQuestionRepositoryInterface;

class AmaQuestionRepository extends BaseRepository implements AmaQuestionRepositoryInterface
{
    /**
     * BaseRepository constructor.
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
        return $this->query->latest()->withTrashed()->get();
    }
}
