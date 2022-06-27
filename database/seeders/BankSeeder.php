<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM banks");

        DB::table("banks")->insert([
            [
                "id" => 1,
                "name" => "Bank Asia Limited",
                "account_name" => "Messrs Mannan Traders",
                "account_no" => "185 985 145 785",
                "branch_name" => "Ashulia",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                "id" => 2,
                "name" => "Islami Bank Bangladesh Limited",
                "account_name" => "Messrs Mannan Traders",
                "account_no" => "185 985 1256 785",
                "branch_name" => "Ashulia",
                "is_active" => true,
                "is_delete" => false,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
