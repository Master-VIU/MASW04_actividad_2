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
        Schema::create('client_address', function (Blueprint $table) {
            $table->id('client_address_id');
            $table->foreignId('client_id')->references('user_client_id')->on('user_client')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('address_id')->references('address_id')->on('address')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['client_id', 'address_id']);
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
        Schema::dropIfExists('client_address');
    }
};
