<?php

namespace App\Repositories;

use App\Models\AmaQuestion;
use App\Repositories\Base\BaseRepository;
use App\Repositories\AmaQuestionRepositoryInterface;

class AmaQuestionRepository extends BaseRepository implements AmaQuestionRepositoryInterface
{
    public function model()
    {
        return AmaQuestion::class;
    }

}
