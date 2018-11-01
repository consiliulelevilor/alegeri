<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class JSONController extends Controller
{
    public function regions(Request $request)
    {
        if (Cache::has('json:regions')) {
            return ($request->query('onlyRegion')) ? json_decode(cache('json:regions'), true)[$request->query('onlyRegion')] : json_decode(cache('json:regions'), true);
        }

        $json = file_get_contents(public_path('/json/regions.json'));
        Cache::put('json:regions', $json, 30);

        return ($request->query('onlyRegion')) ? json_decode($json, true)[$request->query('onlyRegion')] : json_decode($json, true);
    }

    public function institutions(Request $request)
    {
        if (Cache::has('json:institutions')) {
            return ($request->query('onlyRegion')) ? json_decode(cache('json:institutions'), true)[$request->query('onlyRegion')] : json_decode(cache('json:institutions'), true);
        }

        $json = file_get_contents(public_path('/json/institutions.json'));
        Cache::put('json:institutions', $json, 30);

        return ($request->query('onlyRegion')) ? json_decode($json, true)[$request->query('onlyRegion')] : json_decode($json, true);
    }
}
