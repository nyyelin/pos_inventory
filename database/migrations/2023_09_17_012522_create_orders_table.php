<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('total_qty')->default(0);
            $table->string('total_amount')->default(0);
            $table->string('shopping_date')->default(0);
            $table->string('pay')->default(0);
            $table->string('change')->default(0);
            $table->string('discount')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
