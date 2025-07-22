<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');

        view()->composer('layouts.sidebar',function($view) {
            //кеширование
            if (Cache::has('cats')) {
                $cats=Cache::get('cats');

            } else {
                $cats=Category::withCount('posts')->OrderBy('posts_count','desc')->get();
                Cache::put('cats',$cats,30);
            }
            //вывести список статей отсортировав по просмотрам
            $view->with('popular_posts',Post::orderBy('views','desc')->limit(3)->get());
            //вывести список категорий и их количество
            $view->with('cats',$cats);
        });



    }
}
