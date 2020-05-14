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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Quiz' => 'App\Policies\QuizPolicy',
        'App\Question' => 'App\Policies\QuestionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-quiz', function ($user) {
            return $user->is_admin;
        });
        Gate::define('edit-question', function ($user) {
            return $user->is_admin;
        });
    }
}
