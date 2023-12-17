<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::create([
            'id' => 1,
            'name' => 'Dashboard',
            'slug' => 'dashboard',
            'is_menu' => true,
            'menu_icon' => 'mdi mdi-monitor-dashboard',
            'menu_link' => '/dashboard',
            'parent_id' => null
        ]);

        // Profile
        Permission::create([
            'id' => 2,
            'name' => 'Profile',
            'slug' => 'profile',
            'is_menu' => false,
            'menu_icon' => 'mdi mdi-file-cog',
            'menu_link' => null,
            'parent_id' => null
        ]);

        Permission::create([
            'id' => 3,
            'name' => 'User Type',
            'slug' => 'user-type',
            'is_menu' => true,
            'menu_icon' => 'mdi mdi-account-settings',
            'menu_link' => '/user-types',
            'parent_id' => null
        ]);
        Permission::create([
            'id' => 4,
            'name' => 'Users',
            'slug' => 'users',
            'is_menu' => true,
            'menu_icon' => 'mdi mdi-account',
            'menu_link' => '/users',
            'parent_id' => null
        ]);

        // ------------------All Permission ----------------
        // User Type Permission CRUD
        Permission::create([
            'name' => 'List',
            'slug' => 'user-type-list',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 3
        ]);
        Permission::create([
            'name' => 'Store',
            'slug' => 'user-type-store',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 3
        ]);
        Permission::create([
            'name' => 'Update',
            'slug' => 'user-type-update',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 3
        ]);
        Permission::create([
            'name' => 'Delete',
            'slug' => 'user-type-delete',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 3
        ]);

        // User Permission CRUD
        Permission::create([
            'name' => 'List',
            'slug' => 'users-list',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 4
        ]);
        Permission::create([
            'name' => 'Store',
            'slug' => 'users-store',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 4
        ]);
        Permission::create([
            'name' => 'Update',
            'slug' => 'users-update',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 4
        ]);
        Permission::create([
            'name' => 'Delete',
            'slug' => 'users-delete',
            'is_menu' => false,
            'menu_icon' => null,
            'menu_link' => null,
            'parent_id' => 4
        ]);

    }
}
