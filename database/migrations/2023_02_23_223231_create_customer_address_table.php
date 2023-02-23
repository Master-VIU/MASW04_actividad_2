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
            /*$table->primary(['customer_id', 'id address']);      
            $table->foreign('customer_id')
            ->references('customer_id')->on('user_client')
            ->onDelete("cascade")
            ->onUpdate("cascade");   
            $table->foreign('id address')
            ->references('id address')->on('address')
            ->onDelete('set null')
            ->onUpdate("cascade");  */
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
