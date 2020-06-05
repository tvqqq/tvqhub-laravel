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
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function true($data)
    {
        return [
            'success' => true,
            'data' => $data
        ];
    }

    /**
     * @inheritDoc
     */
    public function false($message)
    {
        return [
            'success' => false,
            'message' => $message
        ];
    }

    /**
     * @inheritDoc
     */
    public function create(array $data)
    {
        $create = $this->model->create($data);

        return $this->findById($create->id);
    }

    /**
     * @inheritDoc
     */
    public function getLatest()
    {
        return $this->model->latest()->get();
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return $this->model->latest()->paginate();
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        return $this->findById($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data)
    {
        return $this->findById($id)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function get()
    {
        return $this->model->all();
    }
}
