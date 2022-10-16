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
        Schema::create('tradesperson', function (Blueprint $table){
            $table->increments('id');
            $table->string('firstname',30);
            $table->string('lastname',30);
            $table->integer('addressId');
            $table->text('introduction');
            $table->tinyInteger('highlighted');
            $table->date('startDate');
            $table->date('endDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tradesperson');
    }
};
