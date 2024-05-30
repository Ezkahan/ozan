<?php

namespace Webkul\API\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webkul\Admin\Repositories\ModalBannerRepository;
use Webkul\API\Http\Resources\Banner as BannerResource;

class BannerController extends Controller
{
    protected $bannerRepository;

    public function __construct(ModalBannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        return BannerResource::collection($this->bannerRepository->all());
    }
}
