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
                'icon' => 'fas fa-cog',
                'position' => 2,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],

        ]);

        // LAST ID : 2. NEXT ID : 3 [Settings Position : 12]
    }
}
