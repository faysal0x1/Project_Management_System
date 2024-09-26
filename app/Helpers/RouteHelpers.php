<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

if (!function_exists('defineRoleBasedRoutes')) {
    /**
     * Define role-based routes dynamically.
     *
     * @param \Closure $routeDefinitions
     * @return void
     */
    function defineRoleBasedRoutes(Closure $routeDefinitions)
    {


        // $roles = Cache::remember('user_roles', 3600, function () {
        //     return Role::all()->pluck('name')->toArray();
        // });

        $roles = Role::all()->pluck('name')->toArray();

        if (Auth::check()) {

            $user =  Auth::user();
            $role = $user->roles->first()->name;
            Route::group([
                'prefix' => $role,
                'middleware' => ['role:' . $role],
                'as' => $role . '.',
            ], function () use ($routeDefinitions, $role) {
                $routeDefinitions($role);
            });
        } else {
            foreach ($roles as $role) {
                Route::group([
                    'prefix' => $role,
                    'middleware' => ['role:' . $role],
                    'as' => $role . '.',
                ], function () use ($routeDefinitions, $role) {
                    $routeDefinitions($role);
                });
            }
        }
    }

    function getUserRoleName()
    {
        if (Auth::check()) {
            $user =  Auth::user();
            $role = $user->roles->first();
            return $role->name . '.';
        }
    }
}
