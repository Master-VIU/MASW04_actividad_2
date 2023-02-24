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
        Schema::create('person', function (Blueprint $table) {
            $table->id('person_id');
            $table->string('dni', 12)->nullable(false);
            $table->string('name', 50)->nullable(false);
            $table->string('surname', 50)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->string('telephone', 50)->nullable(false);
            $table->foreignId('user_id')->references('user_id')->on('user')
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
        Schema::dropIfExists('person');
    }
};
