<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin',function($user){
           return ($user->role->name=='Admin');
        });

        Gate::define('admin_manager',function ($user){
            return ($user->role->name=='Admin' || $user->role->name=='Manager');
        });

        Gate::define('manager',function($user){
            return ($user->role->name=='Manager');
        });

        Gate::define('editor_poster',function ($user){
            return ($user->role->name=='Editor' || $user->role->name=='Poster');
        });

        Gate::define('editor',function($user){
            return ($user->role->name=='Editor');
        });

        Gate::define('not_editor',function($user){
            return ($user->role->name!='Editor');
        });

        Gate::define('guest',function($user){
            return ($user->role->name=='Guest');
        });

        Gate::define('poster',function($user){
            return ($user->role->name=='Poster');
        });

        Gate::define('not_poster',function($user){
            return ($user->role->name!='Poster');
        });
    }
}
