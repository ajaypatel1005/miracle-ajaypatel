<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\UserTypePermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->user_type_id == 1) {
            return $next($request);

        } 
        else
        {
            $currentUrl = parse_url(url()->current(), PHP_URL_PATH);
            
            $parents = Permission::whereNull('parent_id')->where('is_menu',1)->where('menu_link',$currentUrl)->get()->toArray();
            
            $userTypePermissions = UserTypePermission::with('permissions')->where('user_type_id', $user->user_type_id)->get()->toArray();
           
            if (!empty($parents)) {
                $parentId = $parents[0]['id'];
                $userTypePermissionIds = array_column($userTypePermissions, 'permission_id');
                
                if (in_array($parentId, $userTypePermissionIds)) {
                    return $next($request);
                }
                else
                {
                    return redirect('/home');
                }
            }
            else
            {
                
                return $next($request);
            }

        //     return $next($request);
         }

        abort(403, 'Unauthorized action.');

       
}
}
