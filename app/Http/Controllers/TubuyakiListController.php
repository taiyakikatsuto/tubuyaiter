<?php

namespace App\Http\Controllers;

use App\Models\Tubuyaki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TubuyakiListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tubuyakies = Tubuyaki::get()->toJson(JSON_PRETTY_PRINT);
        // Log::info($tubuyakies);
        return response($tubuyakies, 500);
    }
}
