<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VarientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM varients");

        DB::table("varients")->insert([
            [
                "id" => 1,
                "name" => "২০",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                "id" => 2,
                "name" => "৫০",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
