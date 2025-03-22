<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Location;
use App\Models\Slider;
use Illuminate\Support\Facades\View;

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
        //
        $categories = Category::all();
        $locations = Location::all();
        $sliders = Slider::where('is_active', 1)->orderBy('id', 'desc')->get();
        View::share(compact('categories', 'locations','sliders'));
    }
}
