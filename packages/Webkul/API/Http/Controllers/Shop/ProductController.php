<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Webkul\Product\Repositories\ProductFlatRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\API\Http\Resources\Catalog\Product as ProductResource;
use Log;

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
    public function __construct(ProductRepository $productRepository, ProductFlatRepository $productFlatRepository)
    {
        $this->productRepository = $productRepository;
        $this->productFlatRepository = $productFlatRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth('customer')->check() && auth('customer')->user()->inventory_source_id != null) {
            $products = $this->productRepository->whereHas('inventories', fn ($query) =>
            $query->where('inventory_source_id', auth('customer')->user()->inventory_source_id))->getAllApi(request()->input('category_id'));
        } else {
            if (!$request->inventory_source_id) {
                $products = $this->productRepository->getAllApi(request()->input('category_id'));
            } else {
                $products = $this->productRepository->where('inventory_source_id', $request->inventory_source_id)->getAllApi(request()->input('category_id'));
            }
        }
        return ProductResource::collection($products);
    }

    public function aksia()
    {
        $aksia_cat = env('AKSIA_CATEGORY', 5);
        $products = $this->productRepository->getAllApi($aksia_cat);

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
        $product = $this->productFlatRepository->findOneWhere(['product_id' => $id, 'locale' => request('locale') ?? 'ru']);
        //        $product = $this->productRepository->findOrFail($id);
        //Log::info($product);
        $productResource =  ProductResource::make(
            $product
        );
        $productResource->categories = $product->product->categories;

        $productResource->related_products = $product->related_products()->get();

        //        Log::info($productResource);
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
