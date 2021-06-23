<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

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
    
    public function test(Request $request){
        //material_name 
        //material_code
        //material_id
        //wh_all 
        //mat_whousetotal_amount 
        $products = json_decode($request->getContent());
        //dd($products);
        foreach($products as $product)
        {
            echo "material_name: " . $product->material_name . "\n"; //product_attribute_values id-2 locale-tm channel-ozan  text_value
            echo "material_code: " . $product->material_code . "\n"; //sku
            echo "material_id: " . $product->material_id . "\n"; //akhasap_id
            echo "wh_all: " . $product->wh_all . "\n";  // product_inventories qty product_id inventgory_source_id vendor_id
            echo "mat_whousetotal_amount: " . $product->mat_whousetotal_amount . "\n";
        }
        return null;
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
