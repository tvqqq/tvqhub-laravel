<?php

namespace App\Repositories;

use App\Models\LarOption;
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

    /**
     * @inheritDoc
     */
    public function get(string $name)
    {
        return $this->model->where('key', $name)->value('value');
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value)
    {
        return $this->model->updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
