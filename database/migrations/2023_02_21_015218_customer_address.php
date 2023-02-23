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
        Schema::create('customer_address', function (Blueprint $table) {     
            /*$table->primary(['id_cliente', 'id_direccion']);      
            $table->foreign('id_cliente')
            ->references('id_cliente')->on('usuario_cliente')
            ->onDelete('cascade');   
            $table->foreign('id_direccion')
            ->references('id_direccion')->on('address')
            ->onDelete('cascade');*/
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
        Schema::dropIfExists('customer_address');
    }
};
