<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement("DELETE FROM permissions");

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'key' => 'user_module',
                'display_name_en' => 'User Module',
                'display_name_bn' => 'ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'key' => 'all_user',
                'display_name_en' => 'All User',
                'display_name_bn' => 'সব ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 3,
                'key' => 'add_user',
                'display_name_en' => '-- Add User',
                'display_name_bn' => '-- যোগ করুন ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 4,
                'key' => 'edit_user',
                'display_name_en' => '-- Edit User',
                'display_name_bn' => '-- সম্পাদনা করুন ব্যবহারকারী',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 5,
                'key' => 'reset_password',
                'display_name_en' => '-- Reset Password',
                'display_name_bn' => '-- পাসওয়ার্ড রিসেট করুন',
                'module_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 6,
                'key' => 'settings',
                'display_name_en' => 'Setting Module',
                'display_name_bn' => 'সেটিংস',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 7,
                'key' => 'app_info',
                'display_name_en' => '-- App Info',
                'display_name_bn' => '-- অ্যাপের তথ্য',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 8,
                'key' => 'edit_app_info',
                'display_name_en' => '-- Edit App Info',
                'display_name_bn' => '-- সম্পাদনা করুন অ্যাপের তথ্য',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 9,
                'key' => 'language',
                'display_name_en' => '-- Language',
                'display_name_bn' => '-- ভাষা',
                'module_id' => 2,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 10,
                'key' => 'system_data',
                'display_name_en' => 'System Data',
                'display_name_bn' => 'সিস্টেম ডাটা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            // Item Type Permission [21-25]
            [
                'id' => 11,
                'key' => 'item_type',
                'display_name_en' => 'Item Type',
                'display_name_bn' => 'পণ্যের ধরন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 12,
                'key' => 'add_item_type',
                'display_name_en' => '-- Add Item Type',
                'display_name_bn' => '-- পণ্যের ধরন যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 13,
                'key' => 'edit_item_type',
                'display_name_en' => '-- Edit Item Type',
                'display_name_bn' => '-- পণ্যের ধরন পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 14,
                'key' => 'view_item_type',
                'display_name_en' => '-- Edit Item Type',
                'display_name_bn' => '-- পণ্যের ধরন দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 15,
                'key' => 'delete_item_type',
                'display_name_en' => '-- Delete Item Type',
                'display_name_bn' => '-- পণ্যের ধরন মুছে ফেলা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Item Permission [26-30]
            [
                'id' => 16,
                'key' => 'item',
                'display_name_en' => 'Item',
                'display_name_bn' => 'পণ্য',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 17,
                'key' => 'add_item',
                'display_name_en' => '-- Add Item',
                'display_name_bn' => '-- পণ্য যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 18,
                'key' => 'edit_item',
                'display_name_en' => '-- Edit Item',
                'display_name_bn' => '-- পণ্য পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 19,
                'key' => 'view_item',
                'display_name_en' => '-- View Item',
                'display_name_bn' => '-- পণ্য দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 20,
                'key' => 'delete_item',
                'display_name_en' => '-- Delete Item',
                'display_name_bn' => '-- পণ্য মুছে ফেলা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Item Varient Permission [31-35]
            [
                'id' => 21,
                'key' => 'varient',
                'display_name_en' => 'Varient',
                'display_name_bn' => 'ভিন্নতা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 22,
                'key' => 'add_varient',
                'display_name_en' => '-- Add Varient',
                'display_name_bn' => '-- ভিন্নতা যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 23,
                'key' => 'edit_varient',
                'display_name_en' => '-- Edit Varient',
                'display_name_bn' => '-- ভিন্নতা পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 24,
                'key' => 'view_varient',
                'display_name_en' => '-- View Varient',
                'display_name_bn' => '-- ভিন্নতা দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 25,
                'key' => 'delete_varient',
                'display_name_en' => '-- Delete Varient',
                'display_name_bn' => '-- ভিন্নতা মুছে ফেলা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Warehouse Permission [36-40]
            [
                'id' => 26,
                'key' => 'warehouse',
                'display_name_en' => 'Warehouse',
                'display_name_bn' => 'গোডাউন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 27,
                'key' => 'add_warehouse',
                'display_name_en' => '-- Add Warehouse',
                'display_name_bn' => '-- গোডাউন যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 28,
                'key' => 'edit_warehouse',
                'display_name_en' => '-- Edit Warehouse',
                'display_name_bn' => '-- গোডাউন পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 29,
                'key' => 'view_warehouse',
                'display_name_en' => '-- View Warehouse',
                'display_name_bn' => '-- গোডাউন দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 30,
                'key' => 'delete_warehouse',
                'display_name_en' => '-- Delete Warehouse',
                'display_name_bn' => '-- গোডাউন মুছে ফেলা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Payment Type Permission [41-45]
            [
                'id' => 31,
                'key' => 'payment_type',
                'display_name_en' => 'Payment Type',
                'display_name_bn' => 'পেমেন্ট ধরন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 32,
                'key' => 'add_payment_type',
                'display_name_en' => '-- Add Payment Type',
                'display_name_bn' => '-- পেমেন্ট ধরন যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 33,
                'key' => 'edit_payment_type',
                'display_name_en' => '-- Edit Payment Type',
                'display_name_bn' => '-- পেমেন্ট ধরন পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 34,
                'key' => 'view_payment_type',
                'display_name_en' => '-- View Payment Type',
                'display_name_bn' => '-- পেমেন্ট ধরন দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 35,
                'key' => 'delete_payment_type',
                'display_name_en' => '-- Delete Payment Type',
                'display_name_bn' => '-- পেমেন্ট ধরন মুছে ফেলা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Transaction Type Permission [46-50]
            [
                'id' => 36,
                'key' => 'transaction_type',
                'display_name_en' => 'Transaction Type',
                'display_name_bn' => 'লেনদেনের ধরন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 37,
                'key' => 'add_transaction_type',
                'display_name_en' => '-- Add Transaction Type',
                'display_name_bn' => '-- লেনদেনের ধরন যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 38,
                'key' => 'edit_transaction_type',
                'display_name_en' => '-- Edit Transaction Type',
                'display_name_bn' => '-- লেনদেনের ধরন পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 39,
                'key' => 'view_transaction_type',
                'display_name_en' => '-- View Transaction Type',
                'display_name_bn' => '-- লেনদেনের ধরন দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 40,
                'key' => 'delete_transaction_type',
                'display_name_en' => '-- Delete Transaction Type',
                'display_name_bn' => '-- লেনদেনের ধরন মুছে ফেলা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            // Supplier Module Permission Start
            [
                'id' => 41,
                'key' => 'supplier',
                'display_name_en' => 'Supplier',
                'display_name_bn' => 'মহাজন',
                'module_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 42,
                'key' => 'all_supplier',
                'display_name_en' => 'All Supplier',
                'display_name_bn' => 'সকল মহাজন',
                'module_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 43,
                'key' => 'add_supplier',
                'display_name_en' => '-- Add Supplier',
                'display_name_bn' => '-- মহাজন যোগ',
                'module_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 44,
                'key' => 'edit_supplier',
                'display_name_en' => '-- Edit Supplier',
                'display_name_bn' => '-- মহাজন পরিবর্তন',
                'module_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 45,
                'key' => 'view_supplier',
                'display_name_en' => '-- View Supplier',
                'display_name_bn' => '-- মহাজন দেখা',
                'module_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 46,
                'key' => 'delete_supplier',
                'display_name_en' => '-- Delete Supplier',
                'display_name_bn' => '-- মহাজন মুছে ফেলা',
                'module_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Supplier Module Permission End


            // Customer Module Permission End
            [
                'id' => 47,
                'key' => 'customer',
                'display_name_en' => 'Customer',
                'display_name_bn' => 'ক্রেতা',
                'module_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 48,
                'key' => 'all_customer',
                'display_name_en' => 'All Customer',
                'display_name_bn' => 'সকল ক্রেতা',
                'module_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 49,
                'key' => 'add_customer',
                'display_name_en' => '-- Add Customer',
                'display_name_bn' => '-- ক্রেতা যোগ',
                'module_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 50,
                'key' => 'edit_customer',
                'display_name_en' => '-- Edit Customer',
                'display_name_bn' => '-- ক্রেতা পরিবর্তন',
                'module_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 51,
                'key' => 'view_customer',
                'display_name_en' => '-- View Customer',
                'display_name_bn' => '-- ক্রেতা দেখা',
                'module_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 52,
                'key' => 'delete_customer',
                'display_name_en' => '-- Delete Customer',
                'display_name_bn' => '-- ক্রেতা মুছে ফেলা',
                'module_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Customer Module Permission End



        ]);



        // Permission Seeder Sequence
        // Please Do Not Remove Comments
        // Sabbir : Supplier + Customer [Add, Edit, View, Delete] 11-20
        // Nazib : Item Type + Item + Item Varient [21-35]
        // Mahbub : Warehouse + PaymentType + TransactionType [Add, Edit, View, Delete] 36-50

        // Last ID: 53, New ID: 54
    }
}
