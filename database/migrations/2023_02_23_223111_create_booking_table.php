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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('review_id');
            $table->string('punctuation', 50)->nullable(false);
            $table->string('opinion', 250)->nullable(false);
            $table->date('date')->nullable(false);
            /*$table->foreign('customer_id')
            ->references('customer_id')->on('customer_user')
            ->onDelete("restrict")
            ->onUpdate("cascade");    
            $table->foreign('product_id')
            ->references('product_id')->on('product')
            ->onDelete("restrict")
            ->onUpdate("cascade");    */
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
        Schema::dropIfExists('booking');
    }
};
