<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\UserTypePermission;
use Illuminate\Support\ServiceProvider;

class PermissionListProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        
        view()->composer('*', function ($view) {

            $user = auth()->user();
            // $currentUrl = parse_url(url()->current(), PHP_URL_PATH);
            // $parents = Permission::whereNull('parent_id')->where('is_menu',1)->where('menu_link',$currentUrl)->get()->toArray();
            $userPermission=null;
            if (!empty($user)) {
                if($user->user_type_id==1)
                {
                    $userPermission = null;  
                }
                else
                {
                    $userPermission = UserTypePermission::with('permissions')->where('user_type_id', $user->user_type_id)->get();
                }
            }
            $view->with('userPermissionList', $userPermission ? $userPermission : null);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
