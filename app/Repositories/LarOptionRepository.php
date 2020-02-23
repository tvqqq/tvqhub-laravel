<?php

namespace App\Repositories;

use App\LarOption;
use App\Repositories\Base\BaseRepository;
use App\Repositories\LarOptionRepositoryInterface;

class LarOptionRepository extends BaseRepository implements LarOptionRepositoryInterface
{
    /**
     * LarOptionRepository constructor.
     *
     * @param LarOption $model
     */
    public function __construct(LarOption $model)
    {
        parent::__construct($model);
    }
}
