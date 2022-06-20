<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM permissions");

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'key' => 'user_module',
                'display_name' => 'User Module',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'key' => 'all_user',
                'display_name' => 'All User',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 3,
                'key' => 'add_user',
                'display_name' => '-- Add User',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 4,
                'key' => 'edit_user',
                'display_name' => '-- Edit User',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 5,
                'key' => 'reset_password',
                'display_name' => '-- Reset Password',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 6,
                'key' => 'settings',
                'display_name' => 'Setting Module',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 7,
                'key' => 'app_info',
                'display_name' => '-- App Info',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 8,
                'key' => 'edit_app_info',
                'display_name' => '-- Edit App Info',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}