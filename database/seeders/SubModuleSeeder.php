<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        
        DB::statement("DELETE FROM sub_modules");

        DB::table('sub_modules')->insert([


            //module id 1 start
            [
                'id' => 1,
                'name' => 'All User',
                'name_bangla' => 'সকল ব্যবহারকারী',
                'key' => 'all_user',
                'position' => 1,
                'route' => 'user.all',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'name' => 'Roles',
                'name_bangla' => 'ভূমিকা',
                'key' => 'roles',
                'position' => 2,
                'route' => 'role.all',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            //module id 1 end

            //module id 2 start
            [
                'id' => 3,
                'name' => 'App Info',
                'name_bangla' => 'অ্যাপের তথ্য',
                'key' => 'app_info',
                'position' => 1,
                'route' => 'app.info.all',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ]
            //module id 2 end

        
        ]);

        //last id 3 new id 4
    }
}