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
     * Return false with message.
     *
     * @param $message
     * @return array
     */
    public function returnFalse($message);

    /**
     * Get all records order by latest.
     *
     * @return mixed
     */
    public function getLatest();


    /**
     * Find the item by id
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);
}
