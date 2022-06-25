<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM modules");

        DB::table('modules')->insert([
            [
                'id' => 1,
                'name_en' => 'User Module',
                'name_bn' => 'ব্যবহারকারী',
                'key' => 'user_module',
                'icon' => 'fas fa-users',
                'position' => 1,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'name_en' => 'Setting Module',
                'name_bn' => 'সেটিংস',
                'key' => 'settings',
                'icon' => 'fas fa-cog',
                'position' => 12,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            [
                'id' => 3,
                'name_en' => 'System Data',
                'name_bn' => 'সিস্টেম ডাটা',
                'key' => 'system_data',
                'icon' => 'fas fa-database',
                'position' => 2,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 4,
                'name_en' => 'Supplier',
                'name_bn' => 'মহাজন',
                'key' => 'supplier',
                'icon' => 'fas fa-truck',
                'position' => 3,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 5,
                'name_en' => 'Customer',
                'name_bn' => 'ক্রেতা',
                'key' => 'customer',
                'icon' => 'fas fa-users',
                'position' => 4,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 6,
                'name_en' => 'Bank',
                'name_bn' => 'ব্যাংক',
                'key' => 'bank',
                'icon' => 'fa fa-university',
                'position' => 5,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 7,
                'name_en' => 'Purchase',
                'name_bn' => 'ক্রয়',
                'key' => 'purchase',
                'icon' => 'fa fa-shopping-cart',
                'position' => 6,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 8,
                'name_en' => 'Stock',
                'name_bn' => 'মজুদ',
                'key' => 'stock',
                'icon' => 'fa fa-tasks',
                'position' => 7,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 9,
                'name_en' => 'Sale',
                'name_bn' => 'বিক্রয়',
                'key' => 'sale',
                'icon' => 'fa fa-outdent',
                'position' => 8,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],

        ]);

        // LAST ID : 5. NEXT ID : 6 [Settings Position : 12]
    }
}
