<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Todo;
use App\Models\Discussion;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('discussion-permissions', function(User $user, Discussion $discussion) {

            return $discussion->user->is($user);
            
        });

        Gate::define('profile-permissions', function(User $CurrentUser, User $user) {

            return $CurrentUser->is($user);

        });

        Gate::define('list-permisions', function (User $user, Todo $todo) {
            return $user->id == $todo->user_id;
        });

         Gate::define('reply-permissions', function(User $CurrentUser, User $user) {

            return $CurrentUser->is($user);

        });

        
    }
}
