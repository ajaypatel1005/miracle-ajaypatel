<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function user_type_permissions()
    {
        return $this->hasMany(UserTypePermission::class);
    }



    public static function menuList($permissions)
    {
        $parents = $permissions->whereNull('parent_id')->sortBy('id')->values();
        self::menuFormetTree($parents, $permissions);
        return $parents;
    }
    private static function menuFormetTree($parents, $permissions)
    {
        foreach ($parents as $parent) {
            $parent->child = $permissions->where('parent_id', $parent->id)->where('is_menu', true)->sortBy('id')->values();
            $parent->permissions = $permissions->where('parent_id', $parent->id)->where('is_menu', false)->sortBy('id')->values();
            self::menuFormetTree($parent->child, $permissions);
        }
    }

    public static function permissionList($per)
    {
        $permissions = $per->makeHidden(['menu_icon', 'menu_link']);
        $parents = $permissions->whereNull('parent_id');
        $parents->shift();
        $parents->values();
        self::permissionFormetTree($parents, $permissions);
        return $parents;
    }
    private static function permissionFormetTree($parents, $permissions)
    {
        foreach ($parents as $parent) {
            $parent->child = $permissions->where('parent_id', $parent->id)->values();
            self::permissionFormetTree($parent->child, $permissions);
        }
    }

}
