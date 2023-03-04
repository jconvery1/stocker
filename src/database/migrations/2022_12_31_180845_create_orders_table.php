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
            $table->id('id');
            $table->dateTime('order_datetime')->nullable();
            $table->string('notes')->nullable();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->foreignId('supplier_id')
                ->references('id')
                ->on('suppliers');
            $table->boolean('fulfilled')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
