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

    /**
     * Find a record with trashed (soft delete) by id.
     *
     * @param int $id
     * @return mixed
     */
    public function findWithTrashed(int $id);
}
