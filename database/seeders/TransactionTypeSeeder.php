<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM transaction_types");

        DB::table("transaction_types")->insert([
            [
                "id" => 1,
                "name" => "ক্রয়",
                "cash_type" => "Cash Out",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                "id" => 2,
                "name" => "বিক্রয়",
                "cash_type" => "Cash In",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
