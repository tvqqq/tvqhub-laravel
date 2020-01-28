<?php

namespace App\Repositories\Base;

use App\Exceptions\RepositoryException;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    public $model;

    /**
     * @var string
     */
    public $query;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $this->model->query();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data)
    {
        return $this->query->create($data);
    }

    /**
     * @inheritDoc
     */
    public function findWithTrashed(int $id)
    {
        return $this->query->withTrashed()->findOrFail($id);
    }
}
