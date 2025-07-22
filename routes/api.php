<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticlesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//получение списка статей контроллер app/http/Controllers/Api/ArticlesController
//тестировать через postman
Route::get('/articles',[ArticlesController::class,"showArticles"]);

//получение одного поста по id
Route::get('/articles/{id}',[ArticlesController::class,"showArticle"]);

//добавление нового поста
Route::post('/articles',[ArticlesController::class,"storeArticle"]);

//изменить статью с помощью метода PUT
//PUT и PATCH не поддерживают файлы, только строка, указать все поля
// postman метод form-data не работает, нужно юзать метод raw (json)
Route::put('/articles/{id}',[ArticlesController::class,"putArticle"]);
//изменить статью с помощью метода PATCH, указать только нужные поля
Route::patch('/articles/{id}',[ArticlesController::class,"patchArticle"]);
//удаление статьи
Route::delete('/articles/{id}',[ArticlesController::class,"deleteArticle"]);

