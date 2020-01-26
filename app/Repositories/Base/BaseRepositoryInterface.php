<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Find all records that match a given conditions
     *
     * @param array $conditions
     * @return Model[]
     */
    public function find(array $conditions = []);
}
