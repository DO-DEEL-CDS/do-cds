<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Project;
use App\Models\Prospect;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Relation::requireMorphMap();

        Relation::morphMap([
            'training' => Training::class,
            'project' => Project::class,
            'user' => User::class,
            'prospect' => Prospect::class,
            'permission' => Permission::class
        ]);
    }
}
