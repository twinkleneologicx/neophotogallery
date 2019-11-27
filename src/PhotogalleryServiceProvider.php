<?php

namespace Neologicx\Photogallery;

use Illuminate\Support\ServiceProvider;

class PhotogalleryServiceProvider extends ServiceProvider
{
    public function boot(){
        // dd('hello');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','gallery');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register(){

    }
}