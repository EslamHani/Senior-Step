<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Page;
use App\Models\Category;
use App\Models\Tag;
use Schema;
class AppServiceProvider extends ServiceProvider
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
        Schema::defaultStringLength(191);
        Schema::enableForeignKeyConstraints();
        view()->share('pages', Page::where('permission', 1)->get());
        view()->share('all_categories', Category::where('permission', 1)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get());
        view()->share('all_tags', Tag::where('permission', 1)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get());
    }
}
