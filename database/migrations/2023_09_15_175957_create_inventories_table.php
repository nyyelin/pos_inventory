<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('storage_id');
            $table->string('qty')->default(0);
            $table->text('barcode');
            $table->string('sell_price');
            $table->string('expired_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('storage_id')
            ->references('id')->on('storages')
            ->onDelete('cascade');
            $table->foreign('item_id')
            ->references('id')->on('items')
            ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
