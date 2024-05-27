<?php

namespace Webkul\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ModalBanner extends Model
{
    protected $fillable = ['title', 'image', 'description', 'url'];
}
