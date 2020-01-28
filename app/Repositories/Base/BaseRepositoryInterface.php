<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Create a new record.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
}
