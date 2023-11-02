<?php

namespace Webkul\Admin\Http\Controllers;

use Log;
use Illuminate\Http\Request;

class AkhasapController extends Controller
{
    public function sync(Request $request)
    {
        Log::debug($request->all());
        return $request->all();
    }
}
