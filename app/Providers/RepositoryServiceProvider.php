<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Repository Interface => Implementation
     *
     * @return array
     */
    private function registerRepo()
    {
        return [
            \App\Repositories\Interfaces\AmaQuestionRepositoryInterface::class =>
                \App\Repositories\AmaQuestionRepository::class,
        ];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repos = $this->registerRepo();

        foreach ($repos as $interface => $implemented) {
            $this->app->bind($interface, $implemented);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
