<?php

namespace Webkul\Admin\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Webkul\Product\Models\Product;
use Webkul\Product\Models\ProductInventory;
use Webkul\Product\Models\ProductFlat;
use Webkul\Product\Models\ProductAttributeValue;

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
            ProductFlat::where('sku', $request->sku)->update([
                'price' => $request->sale_price,
                'min_price' => $request->sale_price,
                'max_price' => $request->sale_price,
                'product_number' => $request->barcode,
                'status' => $request->stock > 0 ? 1 : 0,
            ]);
            ProductAttributeValue::where('product_id', $product->id)
                ->whereIn('attribute_id', [11, 12])
                ->update(['float_value' => $request->sale_price]);
        } else {
            Log::info('Akhasap sync: haryt tapylmady');
        }
    }
}
