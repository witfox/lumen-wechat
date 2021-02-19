<?php
use \Illuminate\Support\Facades\Route;

Route::any("/", "WeChatController@index");

Route::get('wechat-check', function (){
    return 'UI';
})->middleware('lwechat');
