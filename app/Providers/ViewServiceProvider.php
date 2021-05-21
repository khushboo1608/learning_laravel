<?php

namespace App\Providers;


use App\Models\User;
use App\Models\Article;
use App\Models\Category;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['addersses.fields'], function ($view) {
            $userItems = User::pluck('name','id')->toArray();
            $view->with('userItems', $userItems);
        });
        View::composer(['posts.fields'], function ($view) {
            $articleItems = Article::pluck('title','id')->toArray();
            $view->with('articleItems', $articleItems);
        });
        View::composer(['books.fields'], function ($view) {
            $categoryItems = Category::pluck('name','id')->toArray();
            $view->with('categoryItems', $categoryItems);
        });
        // View::composer(['books.fields'], function ($view) {
        //     $categoryItems = Category::pluck('name','id')->toArray();
        //     $view->with('categoryItems', $categoryItems);
        // });
        //
    }
}