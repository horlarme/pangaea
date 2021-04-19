<?php

use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::post('subscribe/{topic}', [TopicController::class, 'subscribe']);
Route::post('publish/{topic}', [TopicController::class, 'publish']);
