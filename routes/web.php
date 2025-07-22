<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Основной файл маршрутизации веб-интерфейса приложения
|
*/

// ========================
// ПУБЛИЧНЫЕ МАРШРУТЫ
// ========================

// Главная страница
Route::get('/', [PostController::class, 'index'])->name('home');


// Публичные маршруты блога
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.single');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.single');
Route::get('/search', [PostController::class, 'search'])->name('search');

// Маршрут просмотра одной категории (добавьте этот блок)
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.single');

// (Опционально) Список всех категорий
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// ========================
// МАРШРУТЫ АУТЕНТИФИКАЦИИ
// ========================

Route::middleware(['guest'])->group(function () {
    // Форма входа
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Форма регистрации
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Выход из системы (доступен только авторизованным)
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ===================================
// ЗАЩИЩЕННЫЕ МАРШРУТЫ ДЛЯ ПОЛЬЗОВАТЕЛЕЙ
// ===================================
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'admin']);

// =====================================
// ЗАЩИЩЕННЫЕ АДМИНИСТРАТИВНЫЕ МАРШРУТЫ
// =====================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::get('/test', function () {
        return "Тестовая страница администратора! Текущий пользователь: " 
             . auth()->user()->name . " (ID: " . auth()->user()->id . ")";
    })->name('test');

    // Дополнительные административные разделы могут быть добавлены здесь
    // Route::resource('posts', PostController::class);
    // Route::resource('categories', CategoryController::class);
	Route::resource('posts', 'App\Http\Controllers\Admin\PostController');
	Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController'); 
	Route::resource('tags', 'App\Http\Controllers\Admin\TagController');
	Route::get('/', 'App\Http\Controllers\Admin\MainController@index')->name('index');
});

// ========================
// ОБРАБОТКА ОШИБОК
// ========================

Route::get('/403', function () {
    return response()->view('errors.403', [], 403);
})->name('error.403');

Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
})->name('error.404');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
