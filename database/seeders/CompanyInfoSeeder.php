<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM company_infos");

        DB::table('company_infos')->insert([
            [
                'id' => 1,
                'name' => 'RP Creations & Apparels Limited',
                'address' => 'House # 21, Road # 13, Ranavola Avenue, Sector # 10, Uttara, Dhaka-1230, Bangladesh',
                'phone' => ' +8801710267919',
                'email' => 'info@rpgroupbd.com',
                'website' => 'https://rpgroupbd.com',
                'web_mail' => 'info@rpgroupbd.com',
                'facebook_profile'  => 'https://www.facebook.com/rptf21',
                'linkedin_profile'  => 'https://bd.linkedin.com/company/rptf',
                'youtube_profile' => '#',
                'description' => 'We aim to put forward the best so that our clients never turn away from our doors unsatisfied. To ensure that we can achieve that, two things are extremely crucial: prioritizing our customers and working as a team. Moreover, our team consists of textile suppliers, designers, service providers, manufacturers, merchandisers, all experts in their own fields.',
                'company_logo' => 'company_logo.png',
                'reporting_logo' => 'reporting_logo.png',
                'created_at' => $date,
                'updated_at' => $date,

            ]
        ]);
    }
}
