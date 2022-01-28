<?php
// ***********
// by lucas de freitas github: https://github.com/lucas-tagdev
// ***********
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiPassportAuthController;
use App\Http\Controllers\API\DeviceController;

 

Route::group(['prefix' => 'v1'], function(){
    Route::post('register', [ApiPassportAuthController::class, 'registro']);
    Route::post('login', [ApiPassportAuthController::class, 'login']);
    
    //GRUPO PRA QUEM POSSUI AUTENTICACAO
    Route::middleware('auth:api')->group(function () {
        
        Route::get('logout', [ApiPassportAuthController::class, 'logout']);
        Route::get('get-user', [ApiPassportAuthController::class, 'userInfo']);
        Route::resource('devices', DeviceController::class);
        Route::post('devices_up', [DeviceController::class, 'atualizar']);
     
    });

    
    

});