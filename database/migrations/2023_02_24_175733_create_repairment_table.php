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
        Schema::create('repairment', function (Blueprint $table) {
            $table->id('repariment_id');
            $table->string('description', 250)->nullable(false);
            $table->timestamp('request_date')->nullable(false);
            $table->timestamp('repairment_date')->nullable(false);
            $table->float('price')->nullable(false);
            $table->foreignId('staff_id')->references('user_staff_id')->on('user_staff')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('client_id')->references('user_client_id')->on('user_client')
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
        Schema::dropIfExists('repairment');
    }
};
