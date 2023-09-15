<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retail_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('storage_id');
            $table->string('qty')->default(0);
            $table->date('expired_date');
            $table->string('buy_price');
            $table->string('total_amount');
            $table->foreign('storage_id')
                    ->references('id')->on('storages')
                    ->onDelete('cascade');
            $table->foreign('item_id')
                    ->references('id')->on('items')
                    ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('retail_transactions');
    }
}
