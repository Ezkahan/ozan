<?php

namespace Webkul\API\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\Product\Facades\ProductImage as ProductImageFacade;

class Product extends JsonResource
{
    public $categories;
    public $related_products;
    /**
     * Create a new resource instance.
     *
     * @return void
     */
    public function __construct($resource)
    {
        $this->productReviewHelper = app('Webkul\Product\Helpers\Review');

        $this->wishlistHelper = app('Webkul\Customer\Helpers\Wishlist');

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request)
    {
        /* assign product */
        $product = $this->product ? $this->product : $this;

        //        dd($this);

        /* get type instance */
        $productTypeInstance = $product->getTypeInstance();

        /* generating resource */
        return [
            /* product's information */
            'id'                     => $product->id,
            'sku'                    => $product->sku,
            'type'                   => $product->type,
            'name'                   => $product->name,
            'url_key'                => $product->url_key,
            'price'                  => (isset($request->inventory_source_id)) ? $this->getInventoryPrice($product, $request->inventory_source_id) : $product->price,
            'minimal_price'          => $productTypeInstance->getMinimalPrice(),
            'formated_price'         => core()->currency((isset($request->inventory_source_id)) ? $this->getInventoryPrice($product, $request->inventory_source_id) : $product->price),
            'formated_minimal_price' => core()->currency($productTypeInstance->getMinimalPrice()),
            'max_quantity'           => $product->max_quantity,
            'short_description'      => $product->short_description,
            'description'            => $product->description,
            'images'                 => ProductImage::collection($product->images),
            //            'videos'                 => ProductVideo::collection($product->videos),
            'base_image'             => ProductImageFacade::getProductBaseImage($product),
            'created_at'             => $product->created_at,
            'updated_at'             => $product->updated_at,
            'brand'                  => $product->brand,
            'brand_label'            => $this->brand_label,
            'stock'                  => $product->totalQuantity(),
            'inventory_source_id'    => $product->inventories,
            /* product's reviews */
            //            'reviews'                => [
            //                'total'          => $total = $this->productReviewHelper->getTotalReviews($product),
            //                'total_rating'   => $total ? $this->productReviewHelper->getTotalRating($product) : 0,
            //                'average_rating' => $total ? $this->productReviewHelper->getAverageRating($product) : 0,
            //                'percentage'     => $total ? json_encode($this->productReviewHelper->getPercentageRating($product)) : [],
            //            ],

            /* product's checks */
            'in_stock'               => $product->haveSufficientQuantity(1),
            'is_saved'               => false,
            'is_wishlisted'          => $this->wishlistHelper->getWishlistProduct($product) ? true : false,
            'is_item_in_cart'        => \Cart::hasProduct($product),
            'show_quantity_changer'  => $this->when(
                $product->type !== 'grouped',
                $product->getTypeInstance()->showQuantityBox()
            ),

            /* product's extra information */
            $this->merge($this->allProductExtraInfo()),

            /* special price cases */
            $this->merge($this->specialPriceInfo()),

            /* super attributes */
            $this->mergeWhen($productTypeInstance->isComposite(), [
                'super_attributes' => Attribute::collection($product->super_attributes),
            ]),

            $this->mergeWhen(!is_null($this->categories), [
                'cateories' => is_null($this->categories) ? null : Category::collection($this->categories)
            ]),

            $this->mergeWhen(!is_null($this->related_products), [
                'related_products' => is_null($this->related_products) ? null : Product::collection($this->related_products)
            ])

        ];
    }

    /**
     * Get special price information.
     *
     * @return array
     */
    private function specialPriceInfo()
    {
        $product = $this->product ? $this->product : $this;

        $productTypeInstance = $product->getTypeInstance();

        return [
            'special_price'          => null,
            'formated_special_price' => null,
            'regular_price'          => null,
            'formated_regular_price' => null,
        ];


        // return [
        //     'special_price'          => $this->when(
        //         $productTypeInstance->haveSpecialPrice(),
        //         $productTypeInstance->getSpecialPrice()
        //     ),
        //     'formated_special_price' => $this->when(
        //         $productTypeInstance->haveSpecialPrice(),
        //         core()->currency($productTypeInstance->getSpecialPrice())
        //     ),
        //     'regular_price'          => $this->when(
        //         $productTypeInstance->haveSpecialPrice(),
        //         data_get($productTypeInstance->getProductPrices(), 'regular_price.price')
        //     ),
        //     'formated_regular_price' => $this->when(
        //         $productTypeInstance->haveSpecialPrice(),
        //         data_get($productTypeInstance->getProductPrices(), 'regular_price.formated_price')
        //     ),
        // ];
    }

    /**
     * Get all product's extra information.
     *
     * @return array
     */
    private function allProductExtraInfo()
    {
        $product = $this->product ? $this->product : $this;

        $productTypeInstance = $product->getTypeInstance();

        return [
            /* grouped product */
            $this->mergeWhen(
                $productTypeInstance instanceof \Webkul\Product\Type\Grouped,
                $product->type == 'grouped'
                    ? $this->getGroupedProductInfo($product)
                    : null
            ),

            /* bundle product */
            $this->mergeWhen(
                $productTypeInstance instanceof \Webkul\Product\Type\Bundle,
                $product->type == 'bundle'
                    ? $this->getBundleProductInfo($product)
                    : null
            ),

            /* configurable product */
            $this->mergeWhen(
                $productTypeInstance instanceof \Webkul\Product\Type\Configurable,
                $product->type == 'configurable'
                    ? $this->getConfigurableProductInfo($product)
                    : null
            ),

            /* downloadable product */
            $this->mergeWhen(
                $productTypeInstance instanceof \Webkul\Product\Type\Downloadable,
                $product->type == 'downloadable'
                    ? $this->getDownloadableProductInfo($product)
                    : null
            ),

            /* booking product */
            $this->mergeWhen(
                $product->type == 'booking',
                $product->type == 'booking'
                    ? $this->getBookingProductInfo($product)
                    : null
            ),
        ];
    }

    /**
     * Get grouped product's extra information.
     *
     * @param  \Webkul\Product\Models\Product
     * @return array
     */
    private function getGroupedProductInfo($product)
    {
        return [
            'grouped_products' => $product->grouped_products->map(function ($groupedProduct) {
                $associatedProduct = $groupedProduct->associated_product;

                $data = $associatedProduct->toArray();

                return array_merge($data, [
                    'qty'                   => $groupedProduct->qty,
                    'isSaleable'            => $associatedProduct->getTypeInstance()->isSaleable(),
                    'formated_price'        => $associatedProduct->getTypeInstance()->getPriceHtml(),
                    'show_quantity_changer' => $associatedProduct->getTypeInstance()->showQuantityBox(),
                ]);
            })
        ];
    }

    /**
     * Get bundle product's extra information.
     *
     * @param  \Webkul\Product\Models\Product
     * @return array
     */
    private function getBundleProductInfo($product)
    {
        return [
            'currency_options' => core()->getAccountJsSymbols(),
            'bundle_options' => app('Webkul\Product\Helpers\BundleOption')->getBundleConfig($product)
        ];
    }

    /**
     * Get configurable product's extra information.
     *
     * @param  \Webkul\Product\Models\Product
     * @return array
     */
    private function getConfigurableProductInfo($product)
    {
        return [
            'variants' => $product->variants
        ];
    }

    /**
     * Get downloadable product's extra information.
     *
     * @param  \Webkul\Product\Models\Product
     * @return array
     */
    private function getDownloadableProductInfo($product)
    {
        return [
            'downloadable_links' => $product->downloadable_links->map(function ($downloadableLink) {
                $data = $downloadableLink->toArray();

                if (isset($data['sample_file'])) {
                    $data['price'] = core()->currency($downloadableLink->price);
                    $data['sample_download_url'] = route('shop.downloadable.download_sample', ['type' => 'link', 'id' => $downloadableLink['id']]);
                }

                return $data;
            }),

            'downloadable_samples' => $product->downloadable_samples->map(function ($downloadableSample) {
                $sample = $downloadableSample->toArray();
                $data = $sample;
                $data['download_url'] = route('shop.downloadable.download_sample', ['type' => 'sample', 'id' => $sample['id']]);
                return $data;
            })
        ];
    }

    /**
     * Get booking product's extra information.
     *
     * @param  \Webkul\Product\Models\Product
     * @return array
     */
    private function getBookingProductInfo($product)
    {
        $bookingProduct = app('\Webkul\BookingProduct\Repositories\BookingProductRepository')->findOneByField('product_id', $product->id);

        $data['slot_index_route'] = route('booking_product.slots.index', $bookingProduct->id);

        if ($bookingProduct->type == 'appointment') {
            $bookingSlotHelper = app('\Webkul\BookingProduct\Helpers\AppointmentSlot');

            $data['today_slots_html'] = $bookingSlotHelper->getTodaySlotsHtml($bookingProduct);
            $data['week_slot_durations'] = $bookingSlotHelper->getWeekSlotDurations($bookingProduct);
            $data['appointment_slot'] = $bookingProduct->appointment_slot;
        }

        if ($bookingProduct->type == 'event') {
            $bookingSlotHelper = app('\Webkul\BookingProduct\Helpers\EventTicket');

            $data['tickets'] = $bookingSlotHelper->getTickets($bookingProduct);
            $data['event_date'] = $bookingSlotHelper->getEventDate($bookingProduct);
        }

        if ($bookingProduct->type == 'rental') {
            $data['renting_type'] = $bookingProduct->rental_slot->renting_type;
        }

        if ($bookingProduct->type == 'table') {
            $bookingSlotHelper = app('\Webkul\BookingProduct\Helpers\TableSlot');

            $data['today_slots_html'] = $bookingSlotHelper->getTodaySlotsHtml($bookingProduct);
            $data['week_slot_durations'] = $bookingSlotHelper->getWeekSlotDurations($bookingProduct);
            $data['table_slot'] = $bookingProduct->table_slot;
        }

        return $data;
    }

    private function getInventoryPrice($product, $inventory_source_id = null)
    {
        foreach ($product->inventories as $inventory) {
            if ($inventory->qty > 0 && $inventory->inventory_source_id == $inventory_source_id) {
                $price = ($inventory->sale_price != null) ? $inventory->sale_price : $product->price;
            }
        }
        return $price;
    }
}