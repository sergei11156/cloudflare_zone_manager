<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResources([
    'accounts' => \App\Http\Controllers\Api\AccountController::class,
    'domains' => \App\Http\Controllers\Api\DomainController::class]);

Route::get('sync', function (\App\Actions\SyncCloudflareDomainsAction $action) {
    $domains = $action->handle();
    return response()->json([
        'status' => true,
        'domains' => $domains
    ]);
});

