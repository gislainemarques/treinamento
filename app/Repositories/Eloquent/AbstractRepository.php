<?php

namespace App\Repositories\Eloquent;

abstract class AbstractRepository {

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function all() {
        return $this->model->all();
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function findOrFail($id) {
        return $this->model->findOrFail($id);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }

    public function deleteById($id) {
        return $this->model->find($id)->delete();
    }

    public function delete($model) {
        return $model->delete();
    }

	protected function resolveModel()
	{
		return app($this->model);
	}
}
