<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM warehouses");

        DB::table("warehouses")->insert([
            [
                "id" => 1,
                "name" => "গোডাউন এক",
                "location" => "অবস্থান এক",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                "id" => 2,
                "name" => "গোডাউন দুই",
                "location" => "অবস্থান দুই",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
