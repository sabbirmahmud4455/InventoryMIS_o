<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_return_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_return_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('lot_id');
            $table->unsignedBigInteger('variant_id');
            $table->unsignedBigInteger('unit_id');
            $table->integer('return_qnty')->default(0);
            $table->double('unit_price')->default(0);
            $table->double('total_price');
            $table->unsignedBigInteger('warehouse_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_return_details');
    }
}
