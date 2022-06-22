<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM payment_types");

        DB::table("payment_types")->insert([
            [
                "id" => 1,
                "name" => "ব্যাংক",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                "id" => 2,
                "name" => "নগদ",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
