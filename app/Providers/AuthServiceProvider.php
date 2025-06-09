<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void

    {

        Gate::define('isAdmin', function ($user) {
            return $user->level == '3' ;
        });

        Gate::define('isUser', function ($user) {
            return $user->level == '1';
        });

        Gate::define('isPatient', function ($user) {
            return $user->level == '2';
        });

        Gate::define('isAdmin-or-isUser', function ($user) {
            return in_array($user->level, [ '3', '1']);
        });

        Gate::define('isAll', function ($user) {
            return in_array($user->level, [ '3', '1','2']);
        });

        Gate::define('isAdmin-or-isPatient', function ($user) {
            return in_array($user->level, [ '3', '2']);
        });
    }
}
