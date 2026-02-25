<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;

class UrlRedirectController extends Controller
{
    /**
     * 
     * @param type $param
     * @return string
     */
    public function getOriginalUrl($param) 
    {
        $code = url('/')."/shurl/".$param;
        $url = ShortUrl::where('short_code', $code)->firstOrFail();

        $url->increment('click_count');

        return redirect($url->original_url);
    }
}
