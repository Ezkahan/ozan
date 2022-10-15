<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Webkul\Category\Models\Category;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\API\Http\Resources\Catalog\Category as CategoryResource;
use Webkul\Product\Repositories\ProductFlatRepository;
use Webkul\Payment\Facades\Payment;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Checkout\Repositories\CartRepository;
use Webkul\API\Http\Resources\Checkout\Cart as CartResource;
use Webkul\API\Http\Resources\Checkout\CartShippingRate as CartShippingRateResource;

class CategoryController extends Controller
{
    /**
     * CategoryRepository object
     *
     * @var \Webkul\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Category\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(
        CartRepository $cartRepository,
        CategoryRepository $categoryRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(
            $this->categoryRepository->getVisibleCategoryTree(request()->input('parent_id'))
        );
    }

    public function getFilters(ProductFlatRepository $productFlatRepository){
        if($cat_id = request()->get('category')){
            $category = $this->categoryRepository->findOrFail($cat_id);
            $filters = $productFlatRepository->getProductsRelatedFilterableAttributes($category);
            return response()->json([
               'data' =>$filters
            ]);
        }
        return response()->json([
            'message' => 'not found'
        ],404);

    }
}
