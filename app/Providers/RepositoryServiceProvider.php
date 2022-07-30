<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $models = array(
            'Role',
            'User',
            'Student',
            'ClassStudent',
            'Candidate',
            'Setting',
            'Vote',
        );

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\Contracts\\{$model}Contract", "App\Repositories\\{$model}Repository");
        }
    }
}
