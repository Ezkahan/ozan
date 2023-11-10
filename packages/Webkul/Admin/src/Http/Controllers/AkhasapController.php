<?php

namespace Webkul\Admin\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Webkul\Product\Models\Product;
use Webkul\Product\Models\ProductInventory;
use Webkul\Product\Models\ProductFlat;

class AkhasapController extends Controller
{
    public function sync(Request $request)
    {
        // Log::info('_____________');
        // Log::debug($request->all());
        // Log::info('_____________');

        // "sku": "J200000696",
        // "stock": "-9.000000",
        // "barcode": "01080",
        // "sale_price": "2.60000"

        $product = Product::where('sku', $request->sku)->first();
        // // Log::info($product);
        // Log::debug('Total before: ' . $product->totalQuantity());
        ProductInventory::where('product_id', $product->id)->update(['qty' => $request->stock]);
        // // Log::debug('Total after: ' . $product->totalQuantity());
        $productFlat = ProductFlat::where('sku', $request->sku)->first();
        $productFlat->update([
            'price' => $request->sale_price,
            'product_number' => $request->barcode,
        ]);
        // Log::info($productFlat);

        // Log::debug($request->all());
        // return $request->all();
    }
}
