<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JSONController extends Controller
{
    public function regions(Request $request)
    {
        return ($request->query('onlyRegion')) ? json_decode(cache('json:regions:raw'), true)[$request->query('onlyRegion')] : json_decode(cache('json:regions:raw'), true);
    }

    public function institutions(Request $request)
    {
        return ($request->query('onlyRegion')) ? json_decode(cache('json:institutions:raw'), true)[$request->query('onlyRegion')] : json_decode(cache('json:institutions:raw'), true);
    }
}
