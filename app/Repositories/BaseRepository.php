<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function getById($id, $relations = [])
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    /**
     * @param array $data
     * @param $id   
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * @param $ids
     * @return int
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * @param $limit
     * @param array $orders
     * @return LengthAwarePaginator
     */
    public function getAll($limit, $orders = [])
    {
        $data = $this->query();
        return $data->paginate($limit);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function getPaginate($limit, $order)
    {
        $query = $this->model;
        $query = $query->orWhere(function ($q) use ($order) {
            if ($order['searchName']) {
                $q->where('name', 'like', '%' . $order['searchName'] . '%');
            }
            // if ($order['page']) {
            //     $q->where()
            // }
        });
        return $query->paginate($limit);
    }
}

