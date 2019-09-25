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
        $active_composer = 'App\Http\ViewComposers\DefaultComposer';
        $template = ['includes.default.sidebar_nav','includes.default.header'];

        // Using class based composers...
        View::composer(
          $template,
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
