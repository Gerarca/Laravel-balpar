<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MainOptionsServiceProvider extends ServiceProvider
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
      view()->composer(
         ['layouts.front', 'front.contacto', 'front.index'],
         'App\Http\ViewComposers\InjectOptionsMain'
     );
    }
}
