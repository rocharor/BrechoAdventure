<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Acl\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name, function($user) use($permission){
                return $user->hasRole($permission->roles);

            });
        }
    }

    /**
     * Get all permissions
     * @return array
     */
    protected function getPermissions()
    {
        try {
            return Permission::with('roles')->get();
            // return Permission::roles->all();
        } catch(\Exception $e) {
            return [];
        }
    }
}
