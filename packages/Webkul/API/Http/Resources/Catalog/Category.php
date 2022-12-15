<?php

namespace Webkul\API\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\Product\Models\Product;
use Webkul\Product\Repositories\ProductFlatRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\API\Http\Resources\Catalog\Product as ProductResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

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

    public function toArray($request)
    {
        $result = [
            'id'               => $this->id,
            'code'             => $this->code,
            'name'             => $this->name,
            'slug'             => $this->slug,
            'display_mode'     => $this->display_mode,
            'description'      => $this->description,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords'    => $this->meta_keywords,
            'status'           => $this->status,
            'image_url'        => $this->image_url,
            'additional'       => is_array($this->resource->additional)
                                    ? $this->resource->additional
                                    : json_decode($this->resource->additional, true),
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
            'position' => $this->position,
        ];
        $categoryId = $this->id;
        if ($request->has('include')) {
            $result['products'] = ProductResource::collection(
                $this->productRepository->getAllApi(request()->input($categoryId))
            //     Product::
            // whereHas('inventories', function ($query){
            //     $query->where('qty', '>', 0);
            // })->whereHas('product_flat', function ($query){
            //     $query->where('status', 1);
            // })->whereHas('categories', function ($query) use ($categoryId){
            //     $query->where('category_id', $categoryId);
            // })
            // ->where('status', true)
            // ->inRandomOrder()
            // ->limit(4)->get()
        );
        }

        return $result;
    }
}