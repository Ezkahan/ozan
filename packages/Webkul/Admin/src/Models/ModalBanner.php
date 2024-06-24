<?php

namespace Webkul\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Inventory\Models\InventorySource;

class ModalBanner extends Model
{
    protected $fillable = ['title', 'image', 'description', 'url', 'inventory_source_id'];


    public function location()
    {
        return $this->hasOne(InventorySource::class);
    }
}
