<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM app_infos");

        DB::table("app_infos")->insert([
            [
                "id" => 1,
                "logo" => "image.png",
                "fav" => "image.png",
                'created_at' => $date,
                'updated_at' => $date,
            ]
        ]);
    }
}
