<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('storage_id');
            $table->string('qty')->default(0);
            $table->string('sell_price')->default(0);
            $table->string('discount')->default(0);
            $table->foreign('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade');
            $table->foreign('item_id')
            ->references('id')->on('items')
            ->onDelete('cascade');
            $table->foreign('storage_id')
            ->references('id')->on('storages')
            ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
