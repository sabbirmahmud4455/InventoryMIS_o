<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM units");

        DB::table("units")->insert([
            [
                "id" => 1,
                "name" => "কেজি",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                "id" => 2,
                "name" => "টন",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
