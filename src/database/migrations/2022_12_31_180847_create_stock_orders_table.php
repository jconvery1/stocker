<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_orders', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->foreignId('stock_item_id')
                ->references('id')
                ->on('stock_items')
                ->onDelete('cascade');
            $table->integer('quantity');
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
        Schema::dropIfExists('stock_orders');
    }
}
