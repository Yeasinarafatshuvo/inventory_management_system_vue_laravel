<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/register', [AuthController::class, 'register']);
Route::group(["middleware" => ["auth:api"]], function(){
    

});