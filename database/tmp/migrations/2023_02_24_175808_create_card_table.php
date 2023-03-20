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
        Schema::create('card', function (Blueprint $table) {
            $table->id('card_id');
            $table->string('card_number')->unique()->nullable(false);
            $table->enum('type', ['credit', 'debit'])->nullable(false);
            $table->integer('cvv')->nullable(false);
            $table->date('expiration_date')->nullable(false);
            $table->foreignId('user_client_id')->references('user_client_id')->on('user_client')
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
        Schema::dropIfExists('card');
    }
};
