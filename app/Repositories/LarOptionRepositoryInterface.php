<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepositoryInterface;

interface LarOptionRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get option by name.
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

    /**
     * Set value to option.
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);
}
