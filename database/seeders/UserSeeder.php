<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            [
                'id' => 1,
                'name' => 'Super admin',
                'email' => 'superadmin@gmail.com',
                'phone' => "01858361812",
                "image" => null,
                "password" => Hash::make(123456),
                "role_id" => 1,
                "is_active" => true,
                "is_super_admin" => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
