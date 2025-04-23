<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/zipcode', function (Request $request) {
    $zipcode = $request->get('zipcode');
    $response = Http::get("https://zipcloud.ibsnet.co.jp/api/search", [
        'zipcode' => $zipcode
    ]);
    return $response->json();
});
