<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['web','auth'])->prefix('/user')->name('user.')->group(function(){
    Route::get('/', [UserController::class,'index'])->name('index');  
});