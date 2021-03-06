<?php

namespace Mckenziearts\Shopper\Repositories;

use Mckenziearts\Shopper\Models\Country;

class CountryRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    private $model;

    public function __construct()
    {
        $this->model = Country::query();
    }

    /**
     * Return New Model instance
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getModel()
    {
        return $this->model->newModelInstance();
    }

    /**
     * Save a new model and return the instance. Allow mass-assignment.
     *
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function save(array $data)
    {
        return $this->model->create([
            'is_enabled'   => $data['is_enabled'],
            'name'         => $data['name'],
            'code'         => $data['code'],
            'iso_3'        => $data['iso_3'],
            'calling_code' => $data['calling_code'],
            'flag'         => $data['code']. '.png',
        ]);
    }

    /**
     * Update a model and return the instance. Allow mass-assignment.
     *
     * @param array $data
     * @param $id
     * @return bool|int
     */
    public function update(array $data, $id)
    {
        return $this->model->findOrFail($id)->update([
            'is_enabled'   => $data['is_enabled'],
            'name'         => $data['name'],
            'code'         => $data['code'],
            'iso_3'        => $data['iso_3'],
            'calling_code' => $data['calling_code'],
            'flag'         => $data['code']. '.png',
        ]);
    }

    /**
     * Delete a record
     *
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Return single record
     *
     * @param int $id
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static|static[]
     */
    public function find($id, array $relations = [])
    {
        if (count($relations) < 1) {
            return $this->model->findOrFail($id);
        }

        return $this->model->with($relations)->findOrFail($id);
    }

    /**
     * Return records paginate list
     *
     * @param int $results
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateList(int $results = 10)
    {
        return $this->model->orderBy('name', 'asc')->paginate($results);
    }

    /**
     * Return all records
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function isEnabled()
    {
        return $this->model->where('is_enabled', true);
    }
}
