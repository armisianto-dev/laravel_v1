<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Models\Base\Menu;

class ComposerServiceProvider extends ServiceProvider
{

    protected $portal_id = 10;

    public function boot()
    {
        $active_composer = 'App\Http\ViewComposers\DeveloperComposer';
        // Using class based composers...
        View::composer(
          'includes.default.sidebar_nav',
          $active_composer
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
