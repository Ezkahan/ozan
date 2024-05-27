<?php

namespace Webkul\Admin\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Webkul\Admin\Models\ModalBanner;

class ModalBannerRepository
{
    protected $model;

    public function __construct(ModalBanner $banner)
    {
        $this->model = $banner;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update(array $data, $id)
    {
        $banner = $this->find($id);
        $banner->update($data);

        return $banner;
    }

    public function delete($id)
    {
        $banner = $this->find($id);

        $image_path = public_path($banner->image);

        dd($image_path);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        return $banner->delete();
    }
}
