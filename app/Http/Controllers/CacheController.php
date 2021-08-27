<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function get(Request $request)
    {
        $key = $request->input('key');
        $value = Cache::get($key);
        info($value);
        return $value;
    }

    public function set(Request $request)
    {
        $key = $request->input('channel_id');
        $value = $request->input('value');
        Cache::forget($key);
        Cache::put($key, $value);
        $val = Cache::get($key);
        return $val;
    }
}
