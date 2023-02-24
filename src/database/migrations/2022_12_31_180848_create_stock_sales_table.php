<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_sales', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('sale_id')
                ->references('id')
                ->on('sales')
                ->onDelete('cascade');
            $table->foreignId('stock_item_id')
                ->references('id')
                ->on('stock_items');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });

        Schema::table('deliveries', function (Blueprint $table) {
            $table->foreignId('order_id')
                ->references('id')
                ->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_sales');
    }
}
