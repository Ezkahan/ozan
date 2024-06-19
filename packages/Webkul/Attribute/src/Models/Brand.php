<?php

namespace Webkul\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Contracts\AttributeOption;

class Brand extends Model
{
    protected $table = 'attribute_options';

    public $timestamps = false;

    public $translatedAttributes = ['label'];

    protected $fillable = ['admin_name', 'attribute_id', 'sort_order', 'swatch_value'];

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

    public function getTranslations()
    {
        return $this->hasMany(AttributeOptionTranslation::class, 'attribute_option_id', 'id');
    }

    public function getTranslation($locale)
    {
        // return $locale;
        return $this->getTranslations()->where('locale', $locale)->first();
    }
}
