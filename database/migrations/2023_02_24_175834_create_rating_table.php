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
        Schema::create('rating', function (Blueprint $table) {
            $table->id('rating_id');
            $table->tinyInteger('rate')->nullable(false);
            $table->string('opinion', 250)->nullable(true);
            $table->date('date')->nullable(false);
            $table->foreignId('user_client_id')->references('user_client_id')->on('user_client')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->references('product_id')->on('products')
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
        Schema::dropIfExists('rating');
    }
};
