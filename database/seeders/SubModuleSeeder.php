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
                'name_en' => 'All User',
                'name_bn' => 'সকল ব্যবহারকারী',
                'key' => 'all_user',
                'position' => 1,
                'route' => 'user.all',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'name_en' => 'Roles',
                'name_bn' => 'ভূমিকা',
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
                'name_en' => 'App Info',
                'name_bn' => 'অ্যাপের তথ্য',
                'key' => 'app_info',
                'position' => 1,
                'route' => 'app.info.all',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 4,
                'name_en' => 'Language',
                'name_bn' => 'ভাষা',
                'key' => 'langugae',
                'position' => 2,
                'route' => 'app_info.lang',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ]
            //module id 2 end


        ]);

        // #########################
        //LAST ID : 4. NEXT ID : 3
    }
}
