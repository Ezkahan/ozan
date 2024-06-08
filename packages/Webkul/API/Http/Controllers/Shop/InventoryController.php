<?php

namespace Webkul\API\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webkul\API\Http\Resources\Inventory\InventorySource;
use Webkul\Inventory\Models\InventorySource as ModelsInventorySource;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = ModelsInventorySource::all();
        return InventorySource::collection($inventories);
    }
}
