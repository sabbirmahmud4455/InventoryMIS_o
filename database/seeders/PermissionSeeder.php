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

            // System Data Module Permission Start

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
            // Item Variant Permission [31-35]
            [
                'id' => 21,
                'key' => 'variant',
                'display_name_en' => 'Variant',
                'display_name_bn' => 'ভিন্নতা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 22,
                'key' => 'add_variant',
                'display_name_en' => '-- Add Variant',
                'display_name_bn' => '-- ভিন্নতা যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 23,
                'key' => 'edit_variant',
                'display_name_en' => '-- Edit Variant',
                'display_name_bn' => '-- ভিন্নতা পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 24,
                'key' => 'view_variant',
                'display_name_en' => '-- View Variant',
                'display_name_bn' => '-- ভিন্নতা দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 25,
                'key' => 'delete_variant',
                'display_name_en' => '-- Delete Variant',
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
            [
                'id' => 65,
                'key' => 'unit',
                'display_name_en' => 'Unit',
                'display_name_bn' => 'ইউনিট',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 66,
                'key' => 'add_unit',
                'display_name_en' => '-- Add Unit',
                'display_name_bn' => '-- ইউনিট যোগ',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 67,
                'key' => 'edit_unit',
                'display_name_en' => '-- Edit Unit',
                'display_name_bn' => '-- ইউনিট পরিবর্তন',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 68,
                'key' => 'view_unit',
                'display_name_en' => '-- View Unit',
                'display_name_bn' => '-- ইউনিট দেখা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 69,
                'key' => 'delete_unit',
                'display_name_en' => '-- Delete Unit',
                'display_name_bn' => '-- ইউনিট মুছে ফেলা',
                'module_id' => 3,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            // System Data Module Permission End

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
            [
                'id' => 76,
                'key' => 'supplier_transactions',
                'display_name_en' => '-- Supplier Transactions',
                'display_name_bn' => '-- মহাজন লেনদেন',
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


            // Bank Module Permission Start
            [
                'id' => 53,
                'key' => 'bank',
                'display_name_en' => 'Bank',
                'display_name_bn' => 'ব্যাংক',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 54,
                'key' => 'all_bank',
                'display_name_en' => 'All Bank',
                'display_name_bn' => 'সকল ব্যাংক',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 55,
                'key' => 'add_bank',
                'display_name_en' => '-- Add Bank',
                'display_name_bn' => '-- ব্যাংক যোগ',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 56,
                'key' => 'edit_bank',
                'display_name_en' => '-- Edit Bank',
                'display_name_bn' => '-- ব্যাংক পরিবর্তন',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 57,
                'key' => 'view_bank',
                'display_name_en' => '-- View Bank',
                'display_name_bn' => '-- ব্যাংক দেখা',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 58,
                'key' => 'delete_bank',
                'display_name_en' => '-- Delete Bank',
                'display_name_bn' => '-- ব্যাংক মুছে ফেলা',
                'module_id' => 6,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Bank Module Permission End


            // Purchase Module Permission Start
            [
                'id' => 59,
                'key' => 'purchase',
                'display_name_en' => 'Purchase',
                'display_name_bn' => 'ক্রয়',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 60,
                'key' => 'all_purchase',
                'display_name_en' => 'All Purchase',
                'display_name_bn' => 'সমস্ত ক্রয়',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 61,
                'key' => 'add_purchase',
                'display_name_en' => '-- Add Purchase',
                'display_name_bn' => '-- ক্রয় যোগ',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 62,
                'key' => 'edit_purchase',
                'display_name_en' => '-- Edit Purchase',
                'display_name_bn' => '-- ক্রয় পরিবর্তন',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 63,
                'key' => 'view_purchase',
                'display_name_en' => '-- View Purchase',
                'display_name_bn' => '-- ক্রয় দেখা',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 64,
                'key' => 'delete_purchase',
                'display_name_en' => '--Delete Purchase',
                'display_name_bn' => '-- ক্রয় মুছে ফেলা',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 77,
                'key' => 'auto_stock',
                'display_name_en' => '--Auto Stock',
                'display_name_bn' => '-- অটো স্টক',
                'module_id' => 7,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            // Purchase Module Permission End

            // Seal Module permission start

            [
                'id' => 70,
                'key' => 'sale',
                'display_name_en' => 'Sale',
                'display_name_bn' => 'বিক্রয়',
                'module_id' => 9,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 71,
                'key' => 'all_sale',
                'display_name_en' => 'All Sale',
                'display_name_bn' => 'সমস্ত বিক্রয়',
                'module_id' => 9,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 72,
                'key' => 'add_sale',
                'display_name_en' => '-- Add Sale',
                'display_name_bn' => '-- বিক্রয় যোগ',
                'module_id' => 9,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 73,
                'key' => 'edit_sale',
                'display_name_en' => '-- Edit Sale',
                'display_name_bn' => '-- বিক্রয় পরিবর্তন',
                'module_id' => 9,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 74,
                'key' => 'view_sale',
                'display_name_en' => '-- View Sale',
                'display_name_bn' => '-- বিক্রয় দেখা',
                'module_id' => 9,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 75,
                'key' => 'delete_sale',
                'display_name_en' => '--Delete Sale',
                'display_name_bn' => '-- বিক্রয় মুছে ফেলা',
                'module_id' => 9,
                'created_at' => $date,
                'updated_at' => $date,
            ],

            // Seal Module permission end



        ]);

        // Last ID: 77, New ID: 78
    }
}
