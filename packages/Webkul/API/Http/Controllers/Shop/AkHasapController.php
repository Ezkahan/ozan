<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use  Webkul\Product\Models\Product;
use  Webkul\Product\Models\ProductAttributeValue;
use  Webkul\Product\Models\ProductInventory;
use Storage;
class AkHasapController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_config = request('_config');
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
            Storage::put('file'.mt_rand(10000,99999).'.txt', $request->getContent());
         
            foreach($products as $product)
            {
                $product = Product::updateOrCreate(['akhasap_id' => $product->material_id],
                [
                    'sku' => $product->material_code,
                    'type' => 'simple',
                    'attribute_family_id' => 1,
                    'akhasap_id' => $product->material_id
                ]
                );
                ProductAttributeValue::updateOrCreate(['product_id' => $product->id],
                [
                    'channel' => 'ozan',
                    'locale' => 'tm',
                    'text_value' => 'material_name',
                    'attribute_id' => 2,
                    'product_id' => $product->id


                ]);
                ProductInventory::updateOrCreate(['product_id' => $product->id],
                [
                    'qty' => $product->wh_all ? $product->wh_all : 0,
                    'inventory_source_id' => 1,
                    'product_id' => $product->id
                ]
                );
                // echo "material_name: " . $product->material_name . "\n"; //product_attribute_values id-2 locale-tm channel-ozan  text_value
                // echo "material_code: " . $product->material_code . "\n"; //sku
                // echo "material_id: " . $product->material_id . "\n"; //akhasap_id
                // echo "wh_all: " . $product->wh_all . "\n";  // product_inventories qty product_id inventgory_source_id vendor_id
                // echo "mat_whousetotal_amount: " . $product->mat_whousetotal_amount . "\n";
            }
            return response()->json(['success'=>true]);
        }
        else{
        return response()->json([
            'error' => 'unauthenticated'
        ],401);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }
}
