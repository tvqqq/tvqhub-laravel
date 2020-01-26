<?php

namespace App\Repositories;

use App\Models\AmaQuestion;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Interfaces\AmaQuestionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AmaQuestionRepository extends BaseRepository implements AmaQuestionRepositoryInterface
{
    public function __construct(AmaQuestion $model)
    {
        parent::__construct($model);
    }
}
