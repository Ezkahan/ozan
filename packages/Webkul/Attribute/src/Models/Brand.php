<?php

namespace Webkul\Attribute\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'attribute_options';

    protected $fillable = ['admin_name', 'attribute_id', 'sort_order', 'swatch_value'];

    public $timestamps = false;

    public function scopeBrands($query)
    {
        return $query->whereHas('attribute', function ($q) {
            $q->where('code', 'brand');
        });
    }

    public function attribute()
    {
        return $this->belongsTo('Webkul\Attribute\Models\Attribute');
    }
}
