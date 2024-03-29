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
        Schema::create('user_client', function (Blueprint $table) {
            $table->id('user_client_id');
            $table->foreignId('shopping_cart_id')->unique()->references('shopping_cart_id')
                ->on('shopping_cart')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignId('user_id')->unique()->references('user_id')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_client');
    }
};
