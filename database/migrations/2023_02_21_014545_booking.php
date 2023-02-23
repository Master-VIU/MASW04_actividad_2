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
            $table->id('id_resenya');
            $table->string('puntuacion', 50);
            $table->string('opinion', 250);
            $table->date('fecha');
            /*$table->foreign('id_cliente')
            ->references('id_cliente')->on('usuario_cliente')
            ->onDelete('cascade');   
            $table->foreign('id_producto')
            ->references('id_producto')->on('product')
            ->onDelete('cascade');   */
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
