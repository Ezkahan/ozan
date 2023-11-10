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
        Log::info('_____________');
        Log::debug($request->all());
        Log::info('_____________');

        $product = Product::where('sku', $request->sku)->first();
        if ($product) {
            ProductInventory::where('product_id', $product->id)->update(['qty' => $request->stock]);
            $productFlat = ProductFlat::where('sku', $request->sku)->first();

            $productFlat->update([
                'price' => $request->sale_price,
                'min_price' => $request->sale_price,
                'max_price' => $request->sale_price,
                'product_number' => $request->barcode,
            ]);
        } else {
            Log::info('Akhasap sync: haryt tapylmady');
        }
    }
}
