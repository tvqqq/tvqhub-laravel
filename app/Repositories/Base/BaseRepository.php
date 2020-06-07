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

    public function true($data)
    {
        return [
            'success' => true,
            'data' => $data
        ];
    }

    public function false($message)
    {
        return [
            'success' => false,
            'message' => $message
        ];
    }

    public function create(array $data)
    {
        $create = $this->model->create($data);

        return $this->findById($create->id);
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getAll($latest = true, $paginate = false)
    {
        $model = $this->model
            ->when($latest, function($query) {
               return $query->latest();
            });
        return $paginate ? $model->paginate() : $model->get();
    }

    public function destroy(int $id)
    {
        return $this->findById($id)->delete();
    }

    public function update(int $id, array $data)
    {
        return $this->findById($id)->update($data);
    }
}
