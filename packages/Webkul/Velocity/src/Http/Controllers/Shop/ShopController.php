<?php

namespace Webkul\Velocity\Http\Controllers\Shop;

use Webkul\Attribute\Models\AttributeOption;
use Webkul\Product\Facades\ProductImage;

class ShopController extends Controller
{
    /**
     * Index to handle the view loaded with the search results
     *
     * @return \Illuminate\View\View
     */
    public function search()
    {
        $results = $this->velocityProductRepository->searchProductsFromCategory(request()->all());

        return view($this->_config['view'])->with('results', $results ? $results : null);
    }

    public function fetchProductDetails($slug)
    {
        $product = $this->productRepository->findBySlug($slug);

        if ($product) {
            $productReviewHelper = app('Webkul\Product\Helpers\Review');

            $galleryImages = ProductImage::getProductBaseImage($product);

            $response = [
                'status'  => true,
                'details' => [
                    'name'         => $product->name,
                    'urlKey'       => $product->url_key,
                    'priceHTML'    => view('shop::products.price', ['product' => $product])->render(),
                    'totalReviews' => $productReviewHelper->getTotalReviews($product),
                    'rating'       => ceil($productReviewHelper->getAverageRating($product)),
                    'image'        => $galleryImages['small_image_url'],
                ]
            ];
        } else {
            $response = [
                'status' => false,
                'slug'   => $slug,
            ];
        }

        return $response;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function categoryDetails()
    {
        $slug = request()->get('category-slug');

        if (!$slug) {
            abort(404);
        }

        switch ($slug) {
            case 'new-products':
            case 'featured-products':
                $count = request()->get('count');

                if ($slug == "new-products") {
                    $products = $this->velocityProductRepository->getNewProducts($count);
                } else if ($slug == "featured-products") {
                    $products = $this->velocityProductRepository->getFeaturedProducts($count);
                }

                $response = [
                    'status'   => true,
                    'products' => $products->map(function ($product) {
                        if (core()->getConfigData('catalog.products.homepage.out_of_stock_items')) {
                            return $this->velocityHelper->formatProduct($product);
                        } else {
                            if ($product->isSaleable()) {
                                return $this->velocityHelper->formatProduct($product);
                            }
                        }
                    }),
                ];

                break;
            default:
                $categoryDetails = $this->categoryRepository->findByPath($slug);

                if ($categoryDetails) {
                    $list = false;
                    $customizedProducts = [];
                    $products = $this->productRepository->getAll($categoryDetails->id);

                    foreach ($products as $product) {
                        $productDetails = [];

                        $productDetails = array_merge($productDetails, $this->velocityHelper->formatProduct($product));

                        array_push($customizedProducts, $productDetails);
                    }

                    $response = [
                        'status'           => true,
                        'list'             => $list,
                        'categoryDetails'  => $categoryDetails,
                        'categoryProducts' => $customizedProducts,
                    ];
                }

                break;
        }

        return $response ?? [
            'status' => false,
        ];
    }

    /**
     * @return array
     */
    public function fetchCategories()
    {
        $formattedCategories = [];
        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);

        foreach ($categories as $category) {
            array_push($formattedCategories, $this->getCategoryFilteredData($category));
        }

        return [
            'status'     => true,
            'categories' => $formattedCategories,
        ];
    }

    /**
     * @param  string  $slug
     * @return array
     */
    public function fetchFancyCategoryDetails($slug)
    {
        $categoryDetails = $this->categoryRepository->findByPath($slug);

        if ($categoryDetails) {
            $response = [
                'status'          => true,
                'categoryDetails' => $this->getCategoryFilteredData($categoryDetails)
            ];
        }

        return $response ?? [
            'status' => false,
        ];
    }

    /**
     * @param  \Webkul\Category\Contracts\Category  $category
     * @return array
     */
    private function getCategoryFilteredData($category)
    {
        $formattedChildCategory = [];

        foreach ($category->children as $child) {
            array_push($formattedChildCategory, $this->getCategoryFilteredData($child));
        }

        return [
            'id'                 => $category->id,
            'slug'               => $category->slug,
            'name'               => $category->name,
            'children'           => $formattedChildCategory,
            'category_icon_path' => $category->category_icon_path,
            'image'              => $category->image
        ];
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getWishlistList()
    {
        return view($this->_config['view']);
    }

    public function getBrands()
    {
        $brands = AttributeOption::where('attribute_id', 25)->paginate(30); //brand id 25

        if (!$brands)
            abort(404);

        return view($this->_config['view'])->with(['brands' => $brands]);
    }

    public function getShops()
    {
        $brands = AttributeOption::where('attribute_id', 29)->paginate(30); //brand id 25

        if (!$brands)
            abort(404);

        return view($this->_config['view'])->with(['shops' => $brands]);
    }


    /**
     * this function will provide the count of wishlist and comparison for logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function getItemsCount()
    {
        if ($customer = auth()->guard('customer')->user()) {

            if (!core()->getConfigData('catalog.products.homepage.out_of_stock_items')) {
                $wishlistItemsCount = $this->wishlistRepository->getModel()
                    ->leftJoin('products as ps', 'wishlist.product_id', '=', 'ps.id')
                    ->leftJoin('product_inventories as pv', 'ps.id', '=', 'pv.product_id')
                    ->where(function ($qb) {
                        $qb
                            ->WhereIn('ps.type', ['configurable', 'grouped', 'downloadable', 'bundle', 'booking'])
                            ->orwhereIn('ps.type', ['simple', 'virtual'])->where('pv.qty', '>', 0);
                    })
                    ->where('wishlist.customer_id', $customer->id)
                    ->where('wishlist.channel_id', core()->getCurrentChannel()->id)
                    ->count('wishlist.id');
            } else {
                $wishlistItemsCount = $this->wishlistRepository->count([
                    'customer_id' => $customer->id,
                    'channel_id'  => core()->getCurrentChannel()->id,
                ]);
            }

            $comparedItemsCount = $this->compareProductsRepository->count([
                'customer_id' => $customer->id,
            ]);

            $response = [
                'status' => true,
                'compareProductsCount'    => $comparedItemsCount,
                'wishlistedProductsCount' => $wishlistItemsCount,
            ];
        }

        return response()->json($response ?? [
            'status' => false
        ]);
    }

    /**
     * This function will provide details of multiple product
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailedProducts()
    {
        // for product details
        if ($items = request()->get('items')) {
            $moveToCart = request()->get('moveToCart');

            $productCollection = $this->velocityHelper->fetchProductCollection($items, $moveToCart);

            $response = [
                'status'   => 'success',
                'products' => $productCollection,
            ];
        }

        return response()->json($response ?? [
            'status' => false
        ]);
    }

    /**
     * This method will fetch products from category.
     *
     * @param  int  $categoryId
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryProducts($categoryId)
    {
        /* fetch category details */
        $categoryDetails = $this->categoryRepository->find($categoryId);

        /* if category not found then return empty response */
        if (!$categoryDetails) {
            return response()->json([
                'products' => [],
                'paginationHTML' => ''
            ]);
        }

        /* fetching products */
        $products = $this->productRepository->getAll($categoryId);
        $products->withPath($categoryDetails->slug);

        /* sending response */
        return response()->json([
            'products' => collect($products->items())->map(function ($product) {
                return $this->velocityHelper->formatProduct($product);
            }),
            'paginationHTML' => $products->appends(request()->input())->onEachSide(1)->links()->toHtml()
        ]);
    }
}
