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
            $table->id('id_user_client');
            $table->foreignId('id_shopping_cart')->references('id_shopping_cart')->on('shopping_cart');
            $table->foreignId('username')->references('username')->on('user');
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
        Schema::dropIfExists('user_client');
    }
};
