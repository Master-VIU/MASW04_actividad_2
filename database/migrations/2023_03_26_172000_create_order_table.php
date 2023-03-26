<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id('order_id');
            $table->float('price')->nullable(false);
            $table->date('order_date')->nullable(false);
            $table->date('shipping_date')->nullable(false);
            $table->string('location', 250)->nullable(false);
            $table->foreignId('card_id')->references('card_id')->on('card')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('address_id')->references('address_id')->on('address')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('client_id')->references('user_client_id')->on('user_client')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('shopping_cart_id')->references('shopping_cart_id')->on('shopping_cart')
                ->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('order');
    }
};
