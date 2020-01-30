<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Repositories\UrlRepositoryInterface;
use App\Url;

class UrlRepository extends BaseRepository implements UrlRepositoryInterface
{
    /**
     * UrlRepository constructor.
     *
     * @param Url $model
     */
    public function __construct(Url $model)
    {
        parent::__construct($model);
    }
}
