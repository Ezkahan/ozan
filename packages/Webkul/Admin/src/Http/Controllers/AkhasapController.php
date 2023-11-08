<?php

namespace Webkul\Admin\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Webkul\Product\Models\Product;
use Webkul\Product\Models\ProductInventory;

class AkhasapController extends Controller
{
    public function sync(Request $request)
    {
        $product = Product::where('sku', 'kn00003590')->get();
        Log::info($product);
        Log::debug('Total before: ' . $product->totalQuantity());
        ProductInventory::where('product_id', $product->id)->update(['qty' => 100]);
        Log::debug('Total after: ' . $product->totalQuantity());
        // Log::debug($request->all());
        // return $request->all();
    }
}
