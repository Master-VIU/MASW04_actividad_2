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
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('category_id')->references('category_id')->on('category')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->string('name', 100)->nullable(false);
            $table->string('description', 250)->nullable(false);
            $table->float('price')->nullable(false);
            $table->string('properties', 250)->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // find way to check that price is always above zero point zero
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
