<?php

namespace CmdMakeRepo;

use CmdMakeRepo\Console\RepositoryInterfaceMakeCommand;
use CmdMakeRepo\Console\RepositoryMakeCommand;
use Illuminate\Support\ServiceProvider;

class CmdMakeRepoServiceProvider extends ServiceProvider
{
    protected $commands = [
        RepositoryMakeCommand::class,
        RepositoryInterfaceMakeCommand::class
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
