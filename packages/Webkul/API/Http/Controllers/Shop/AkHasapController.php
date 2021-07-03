<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Category\Repositories\CategoryRepository;
use  Webkul\Product\Models\Product;
use  Webkul\Product\Models\ProductAttributeValue;
use  Webkul\Product\Models\ProductInventory;
use  Webkul\Product\Models\ProductFlat;
use Storage;
class AkHasapController extends Controller
{
    use DispatchesJobs, ValidatesRequests;
    /**
     * CategoryRepository object
     *
     * @var \Webkul\Category\Repositories\CategoryRepository
     */

    public function fixdb(Request $request,$page){
        // $header = $request->header('Authorization');
        // if($header == '0a358dd1-2b07-4cdf-9d9a-a68dac6bb5fc')
        // {
           $products = Product::all();

           foreach($products as $rawproduct)
           {
               try{
            $product = $rawproduct->product_flats()->first();
               //locale en
             ProductAttributeValue::updateOrCreate([
                'product_id' => $product->product_id,
                'attribute_id' => 2,
                'locale' => 'tm'
            ],
                [
                    'text_value' => $product->name,
                    'channel' => 'default',

                ]
            );

            ProductAttributeValue::updateOrCreate([
                'product_id' => $product->product_id,
                'attribute_id' => 2,
                'locale' => 'ru'
            ],
                [
                    'text_value' => $product->name,
                    'channel' => 'default',
                ]
                );

            ProductAttributeValue::updateOrCreate([
                'product_id' => $product->product_id,
                'attribute_id' => 2,
                'locale' => 'en'
            ],
                [
                    'text_value' => $product->name,
                    'channel' => 'default',


                ]
                );

           ProductAttributeValue::updateOrCreate([
            'product_id' => $product->product_id,
            'attribute_id' => 11
        ],
            [
                'float_value' => $product->price

            ]
            );

            ProductAttributeValue::updateOrCreate([
                'product_id' => $product->product_id,
                'attribute_id' => 12
            ],
                [
                    'float_value' => $product->cost

                ]
                );
            ProductAttributeValue::updateOrCreate([
                'product_id' => $product->product_id,
                'attribute_id' => 7
            ],
                [
                    'boolean_value' => 1

                ]
                );
                ProductAttributeValue::updateOrCreate([
                    'product_id' => $product->product_id,
                    'attribute_id' => 26
                ],
                    [
                        'boolean_value' => false

                    ]
                    );


            }
            catch(Exception $e)
            {

            }
        }

       }
         //name -> 2 locale leri bar
         //price -> 11
         // url_key -> 3
         // visible_individually ->7  true
         // guest_checkout -> 26 false

        // }


    public function storeCategories(Request $request){

        $header = $request->header('Authorization');

        if($header !== '0a358dd1-2b07-4cdf-9d9a-a68dac6bb5fc') {
            return response()->json([
                'error' => 'unauthenticated'
            ],401);
        }

        $data = json_decode($request->getContent());

        if(!$data && !is_array($data)){
            return response()->json([
                'error' => 'bad request data empty or not array'
            ],400);
        }

        try {
            DB::beginTransaction();

            Storage::put('akhasaplogs/file_category_'.time().'.txt', $request->getContent());

            foreach ($data as $item){

                $category = \Category::updateOrCreate([
                    'id' => $item->id
                ],[
                    'name' => $item->name,
                    'status' => $item->status,
                    'position' => $item->position,
                    'slug' => $item->slug,
                    'display_mode' => 'products_only',
                    'parent_id' => $item->parent_id
                ]);
            }

            DB::commit();

            return response()->json(['success'=>true]);
        }
        catch (\Exception $ex){
            DB::rollBack();
            Log::error($ex);
            return response()->json([
                'error' => $ex->getMessage()
            ],500);
        }

    }


    public function store(Request $request){
        $header = $request->header('Authorization');
        if($header == '0a358dd1-2b07-4cdf-9d9a-a68dac6bb5fc')
        {
            //material_name
            //material_code
            //material_id
            //wh_all
            //mat_whousetotal_amount
            $products = json_decode($request->getContent());

            //dd($products);
            Storage::put('akhasaplogs/file'.mt_rand(10000,99999).'.txt', $request->getContent());

            try {
                DB::beginTransaction();
                foreach($products as $akhasap_product)
                {
                    $sku = strtolower($akhasap_product->material_code);
                    $product = Product::updateOrCreate(['akhasap_id' => $akhasap_product->material_id],
                        [
                            'sku' => $sku ,
                            'type' => 'simple',
                            'attribute_family_id' => 1,
                            'akhasap_id' => $akhasap_product->material_id
                        ]
                    );
                    ProductFlat::updateOrCreate(['product_id' => $product->id,'locale' => 'tm'],
                        [
                            'sku' => $sku ,
                            'type' => 'simple',
                            'name' => $akhasap_product->material_name,
                            'status' => 1,
                            'price' => $akhasap_product->mat_sale_price ,
                            'cost' => $akhasap_product->mat_purch_price,
                            'channel' => 'default'

                        ]);
                    ProductFlat::updateOrCreate(['product_id' => $product->id,'locale' => 'en'],
                        [
                            'sku' => $sku ,
                            'type' => 'simple',
                            'name' => $akhasap_product->material_name,
                            'status' => 1,
                            'price' => $akhasap_product->mat_sale_price ,
                            'cost' => $akhasap_product->mat_purch_price,
                            'channel' => 'default'

                        ]);
                    ProductFlat::updateOrCreate(['product_id' => $product->id,'locale' => 'ru'],
                        [
                            'sku' => $sku ,
                            'type' => 'simple',
                            'name' => $akhasap_product->material_name,
                            'status' => 1,
                            'price' => $akhasap_product->mat_sale_price ,
                            'cost' => $akhasap_product->mat_purch_price,
                            'channel' => 'default'

                        ]);
                    ProductAttributeValue::updateOrCreate(['product_id' => $product->id, 'attribute_id' => 2,'locale' => 'tm'],
                        [
                            'channel' => 'default',

                            'text_value' => $akhasap_product->material_name,

                            'product_id' => $product->id

                        ]);
                    ProductAttributeValue::updateOrCreate(['product_id' => $product->id,'locale' => 'en','attribute_id' => 2],
                        [
                            'channel' => 'default',

                            'text_value' => $akhasap_product->material_name,

                            'product_id' => $product->id


                        ]);
                    ProductAttributeValue::updateOrCreate(['product_id' => $product->id,'locale' => 'ru','attribute_id' => 2],
                        [
                            'channel' => 'default',

                            'text_value' => $akhasap_product->material_name,

                            'product_id' => $product->id


                        ]);
                    ProductInventory::updateOrCreate(['product_id' => $product->id],
                        [
                            'qty' => $akhasap_product->wh_all ? $akhasap_product->wh_all : 0,
                            'inventory_source_id' => 1,
                            'product_id' => $product->id
                        ]
                    );


                    ProductAttributeValue::updateOrCreate([
                        'product_id' => $product->product_id,
                        'attribute_id' => 11
                    ],
                        [
                            'float_value' => $akhasap_product->mat_sale_price

                        ]
                    );

                    ProductAttributeValue::updateOrCreate([
                        'product_id' => $product->product_id,
                        'attribute_id' => 12
                    ],
                        [
                            'float_value' => $akhasap_product->mat_purch_price

                        ]
                    );
                    ProductAttributeValue::updateOrCreate([
                        'product_id' => $product->product_id,
                        'attribute_id' => 7
                    ],
                        [
                            'boolean_value' => 1

                        ]
                    );
                    ProductAttributeValue::updateOrCreate([
                        'product_id' => $product->product_id,
                        'attribute_id' => 26
                    ],
                        [
                            'boolean_value' => false

                        ]
                    );
                    ProductAttributeValue::updateOrCreate([
                        'product_id' => $product->product_id,
                        'attribute_id' => 3
                    ],
                        [
                            'text_value' => $sku,


                        ]
                    );
                    // echo "material_name: " . $product->material_name . "\n"; //product_attribute_values id-2 locale-tm channel-ozan  text_value
                    // echo "material_code: " . $product->material_code . "\n"; //sku
                    // echo "material_id: " . $product->material_id . "\n"; //akhasap_id
                    // echo "wh_all: " . $product->wh_all . "\n";  // product_inventories qty product_id inventgory_source_id vendor_id
                    // echo "mat_whousetotal_amount: " . $product->mat_whousetotal_amount . "\n";
                }
                DB::commit();
                return response()->json(['success'=>true]);
            }
            catch (\Exception $exception){
                DB::rollBack();
                Log::error($exception);
            }


        }
        else{
        return response()->json([
            'error' => 'unauthenticated'
        ],401);
        }
    }

}
