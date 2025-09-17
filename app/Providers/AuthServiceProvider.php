<?php

namespace App\Providers;

use App\Models\Immigration;
use App\Policies\ImmigrationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Immigration::class => ImmigrationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Global ADMIN bypass: if user is admin, allow everything
        Gate::before(function ($user, string $ability) {
            try {
                if (function_exists('user_roles') && in_array('admin', user_roles(), true)) {
                    return true;
                }
                if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
                    return true;
                }
            } catch (\Throwable $e) {
                // ignore and fall through
            }

            return null; // continue to normal policy checks for non-admins
        });
    }
}
