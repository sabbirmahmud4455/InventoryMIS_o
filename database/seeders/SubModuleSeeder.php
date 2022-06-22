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

            //module id 2  start
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
            ],
            //module id 2 end


            // Module ID 3 [System Data] start
            [
                'id' => 5,
                'name_en' => 'Supplier',
                'name_bn' => 'মহাজন',
                'key' => 'supplier',
                'position' => 1,
                'route' => 'supplier.all',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            [
                'id' => 6,
                'name_en' => 'Customer',
                'name_bn' => 'ক্রেতা',
                'key' => 'customer',
                'position' => 2,
                'route' => 'customer.all',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            [
                'id' => 7,
                'name_en' => 'Item Type',
                'name_bn' => 'পণ্যের ধরন',
                'key' => 'item_type',
                'position' => 3,
                'route' => 'item_type.index',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 8,
                'name_en' => 'Item',
                'name_bn' => 'পণ্য',
                'key' => 'item',
                'position' => 4,
                'route' => 'app_info.lang',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 9,
                'name_en' => 'Item Varient',
                'name_bn' => 'পণ্যের ভিন্নতা',
                'key' => 'item_varient',
                'position' => 5,
                'route' => 'app_info.lang',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 10,
                'name_en' => 'Warehouse',
                'name_bn' => 'গোডাউন ',
                'key' => 'warehouse',
                'position' => 6,
                'route' => 'warehouse.index',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 11,
                'name_en' => 'Payment Type',
                'name_bn' => 'পেমেন্ট ধরন',
                'key' => 'payment_type',
                'position' => 7,
                'route' => 'app_info.lang',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 12,
                'name_en' => 'Transaction Type',
                'name_bn' => ' লেনদেনের ধরন',
                'key' => 'transaction_type',
                'position' => 8,
                'route' => 'app_info.lang',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Module ID 3 [System Data] end





        ]);

        // #########################
        //LAST ID : 12. NEXT ID : 13
    }
}
