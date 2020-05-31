<?php

namespace App\Repositories;

use App\Models\BucketList;
use App\Repositories\Base\BaseRepository;
use App\Repositories\BucketListRepositoryInterface;

class BucketListRepository extends BaseRepository implements BucketListRepositoryInterface
{
    /**
     * BucketListRepository constructor.
     *
     * @param BucketList $model
     */
    public function __construct(BucketList $model)
    {
        parent::__construct($model);
    }
}
