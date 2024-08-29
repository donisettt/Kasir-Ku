<?php

namespace App\Providers;

use Gate;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('manajer', function (User $user) {
            return $user->role === 'manajer';
        });
        Gate::define('kasir', function (User $user) {
            return $user->role === 'kasir';
        });
        Gate::define('role', function (User $user, ...$role) {
            return in_array($user->role, $role);
        });
        Gate::define('transaksi-show', function (User $user, Transaksi $transaksi) {
            if ($user->role == 'manajer') {
                return true;
            } else {
                return $user->id == $transaksi->user_id;
            }
        });
    }
}