<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "contact_no" => "9999999999",
            "password" => bcrypt("12345678"),
            'is_active' => true,
            'is_verify' =>  true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'user_type_id' => 1,
        ]);

        User::create([
            "name" => "Moderator",
            "email" => "moderator@gmail.com",
            "contact_no" => "8888888888",
            "password" => bcrypt("12345678"),
            'is_active' => true,
            'is_verify' =>  true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'user_type_id' => 2,
        ]);
    }
}
