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
        Schema::create('staff', function (Blueprint $table) {
            $table->string('dni', 9)->primary();
            $table->string('cif', 9);
            $table->enum('rol', ['tecnico', 'asesor']);
            /*$table->foreign('id_usuario')
            ->references('id_usuario')->on('usuario_trabajador')
            ->onDelete('cascade');  */ 
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
        Schema::dropIfExists('staff');
    }
};
