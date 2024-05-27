<?php

namespace Webkul\Attribute\Repositories;

use Webkul\Attribute\Models\Brand;

class BrandRepository
{
    protected $model;

    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }

    public function all()
    {
        return $this->model->brands()->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->brands()->find($id);
    }

    public function update(array $data, $id)
    {
        $brand = $this->find($id);
        $brand->update($data);

        return $brand;
    }

    public function delete($id)
    {
        $brand = $this->find($id);
        return $brand->delete();
    }
}
