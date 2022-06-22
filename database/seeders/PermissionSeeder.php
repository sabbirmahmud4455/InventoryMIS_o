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
                'display_name_en' => 'User Module',
                'display_name_bn' => 'ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'key' => 'all_user',
                'display_name_en' => 'All User',
                'display_name_bn' => 'সব ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 3,
                'key' => 'add_user',
                'display_name_en' => '-- Add User',
                'display_name_bn' => '-- যোগ করুন ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 4,
                'key' => 'edit_user',
                'display_name_en' => '-- Edit User',
                'display_name_bn' => '-- সম্পাদনা করুন ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 5,
                'key' => 'reset_password',
                'display_name_en' => '-- Reset Password',
                'display_name_bn' => '-- পাসওয়ার্ড রিসেট করুন',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 6,
                'key' => 'settings',
                'display_name_en' => 'Setting Module',
                'display_name_bn' => 'সেটিংস',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 7,
                'key' => 'app_info',
                'display_name_en' => '-- App Info',
                'display_name_bn' => '-- অ্যাপের তথ্য',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 8,
                'key' => 'edit_app_info',
                'display_name_en' => '-- Edit App Info',
                'display_name_bn' => '-- সম্পাদনা করুন অ্যাপের তথ্য',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 9,
                'key' => 'language',
                'display_name_en' => '-- Language',
                'display_name_bn' => '-- ভাষা',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            // Supplier Permission [id : 10-14]
                // SABBIR
            // Customer Permission [id : 15-19]
                // SABBIR
            // Item Type Permission [20-24]
                // NAZIB
            // Item Permission [25-29]
                // NAZIB
            // Item Varient Permission [30-34]
                // NAZIB
            // Warehouse Permission [35-39]
                // MAHBUB
            // Payment Type Permission [40-44]
                // MAHBUB
            // Transaction Type Permission [45-49]
                // MAHBUB
        ]);



        // Permission Seeder Sequence
        // Please Do Not Remove Comments
        // Sabbir : Supplier + Customer [Add, Edit, View, Delete] 10-19
        // Nazib : Item Type + Item + Item Varient [20-34]
        // Mahbub : Warehouse + PaymentType + TransactionType [Add, Edit, View, Delete] 35-49

        // Last ID: 49, New ID: 50
    }
}
