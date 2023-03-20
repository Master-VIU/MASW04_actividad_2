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
        Schema::create('shopping_cart_product', function (Blueprint $table) {
            $table->id('shopping_cart_product_id');
            $table->foreignId('shopping_cart_id')->references('shopping_cart_id')->on('shopping_cart')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->references('product_id')->on('product')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity')->nullable(false);
            $table->unique(['shopping_cart_id', 'product_id']);
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
        Schema::dropIfExists('shopping_cart_product');
    }
};
