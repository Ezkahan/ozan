<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\API\Http\Resources\Catalog\Category;
use Webkul\Product\Repositories\ProductFlatRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\API\Http\Resources\Catalog\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var \Webkul\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    protected $productFlatRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository,ProductFlatRepository $productFlatRepository)
    {
        $this->productRepository = $productRepository;
        $this->productFlatRepository = $productFlatRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd($this->productRepository->getAllApi(request()->input('category_id')));
        return ProductResource::collection($this->productRepository->getAllApi(request()->input('category_id')));
    }

    public function aksia(){
        $products = $this->productRepository->getAllApi(env('AKSIA_CATEGORY'));

        return ProductResource::collection($products);
    }
    /**
     * Returns a individual resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $product = $this->productFlatRepository->findOrFail($id);
//        dd($product->brand_label);

        $productResource =  ProductResource::make(
            $product
        );
        $productResource->categories = $product->product->categories;

        $productResource->related_products = $product->product->related_products;

        return $productResource;
    }

    /**
     * Returns product's additional information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function additionalInformation($id)
    {
        return response()->json([
            'data' => app('Webkul\Product\Helpers\View')->getAdditionalData($this->productRepository->findOrFail($id)),
        ]);
    }

    /**
     * Returns product's additional information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configurableConfig($id)
    {
        return response()->json([
            'data' => app('Webkul\Product\Helpers\ConfigurableOption')->getConfigurationConfig($this->productRepository->findOrFail($id)),
        ]);
    }
}
