<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Repositories\FacebookerRepositoryInterface;

class FacebookerRepository extends BaseRepository implements FacebookerRepositoryInterface
{
    /**
     * FacebookerRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
