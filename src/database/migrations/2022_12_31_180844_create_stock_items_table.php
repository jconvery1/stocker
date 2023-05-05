<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->unique();
            $table->foreignId('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('cascade');
            $table->string('gender');
            $table->string('brand');
            $table->string('colour');
            $table->string('shoe_size');
            $table->string('material');
            $table->string('category');
            $table->integer('price');
            $table->integer('stock_level');
            $table->string('barcode');
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
        Schema::dropIfExists('stock_items');
    }
}
