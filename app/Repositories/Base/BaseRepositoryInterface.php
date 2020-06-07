<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{

    /**
     * Return true with data.
     *
     * @param $data
     * @return array
     */
    public function true($data);

    /**
     * Return false with message.
     *
     * @param $message
     * @return array
     */
    public function false($message);

    /**
     * Create a new record.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Find the item by id
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * Get all resources with pagination when needed.
     *
     * @param bool $latest
     * @param bool $paginate
     * @return mixed
     */
    public function getAll($latest = true, $paginate = false);

    /**
     * Delete a record.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);

    /**
     * Update a record.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);
}
