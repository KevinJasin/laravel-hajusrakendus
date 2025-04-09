<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\MyFavoriteSubject;

Route::get('/subjects', function () {
    $limit = request()->query('limit', 5); // default to 5

    return Cache::remember("subjects_limit_$limit", 60, function () use ($limit) {
        return MyFavoriteSubject::latest()->take($limit)->get();
    });
});

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
