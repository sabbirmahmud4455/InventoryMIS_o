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
                'name' => 'User Module',
                'key' => 'user_module',
                'icon' => 'fas fa-users',
                'position' => 1,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'name' => 'Setting Module',
                'key' => 'settings',
                'icon' => 'fas fa-cog',
                'position' => 2,
                'route' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            
        ]);
    }
}