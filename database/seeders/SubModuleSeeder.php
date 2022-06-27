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
                'key' => 'language',
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
                'name_en' => 'Unit',
                'name_bn' => 'ইউনিট',
                'key' => 'unit',
                'position' => 1,
                'route' => 'unit.index',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 6,
                'name_en' => 'Variant',
                'name_bn' => 'ভিন্নতা',
                'key' => 'variant',
                'position' => 2,
                'route' => 'variant.index',
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
                'route' => 'item.index',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 9,
                'name_en' => 'Warehouse',
                'name_bn' => 'গোডাউন ',
                'key' => 'warehouse',
                'position' => 5,
                'route' => 'warehouse.index',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 10,
                'name_en' => 'Payment Type',
                'name_bn' => 'পেমেন্ট ধরন',
                'key' => 'payment_type',
                'position' => 6,
                'route' => 'payment.type.index',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 11,
                'name_en' => 'Transaction Type',
                'name_bn' => ' লেনদেনের ধরন',
                'key' => 'transaction_type',
                'position' => 7,
                'route' => 'transaction.type.index',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Module ID 3 [System Data] end

            // Module ID 4 [Supplier] start
            [
                'id' => 12,
                'name_en' => 'All Supplier',
                'name_bn' => 'সকল মহাজন',
                'key' => 'all_supplier',
                'position' => 1,
                'route' => 'supplier.all',
                'module_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Module ID 4 [Supplier] end

            // Module ID 4 [Customer] start
            [
                'id' => 13,
                'name_en' => 'All Customer',
                'name_bn' => 'সকল ক্রেতা',
                'key' => 'all_customer',
                'position' => 1,
                'route' => 'customer.all',
                'module_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Module ID 4 [Customer] end

            // Module ID 6 [Bank] Start
            [
                'id' => 14,
                'name_en' => 'All Banks',
                'name_bn' => 'সকল ব্যাংক',
                'key' => 'bank',
                'position' => 1,
                'route' => 'customer.all',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 15,
                'name_en' => 'Add Bank',
                'name_bn' => 'ব্যাংক যোগ করুন',
                'key' => 'add_bank',
                'position' => 2,
                'route' => 'customer.all',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 16,
                'name_en' => 'Bank Transaction',
                'name_bn' => 'ব্যাংক লেনদেন',
                'key' => 'bank_transaction',
                'position' => 3,
                'route' => 'customer.all',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Module ID 6 [Bank] End

            // Module ID 7 [Purchase] Start
            [
                'id' => 16,
                'name_en' => 'All Purchase',
                'name_bn' => 'সমস্ত ক্রয়',
                'key' => 'all_purchase',
                'position' => 1,
                'route' => 'purchase.index',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 17,
                'name_en' => 'New Purchase',
                'name_bn' => 'নতুন ক্রয়',
                'key' => 'new_purchase',
                'position' => 2,
                'route' => 'purchase.add',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Module ID 7 [Purchase] End







        ]);

        // #########################
        //LAST ID : 17. NEXT ID : 18
    }
}
