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
        if(!Schema::hasTable('tradesperson_professions')){
            Schema::create('tradesperson_professions', function (Blueprint $table) {
                $table->unsignedBigInteger('tradesperson_id');
                $table->unsignedBigInteger('profession_id');
                //$table->foreign('tradesperson_id')->references('id')->on('tradespersons')->onDelete('cascade');
                //$table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
                //$table->foreignId('tradesperson_id')->constrained('tradespersons');
                //$table->foreignId('profession_id')->constrained('professions');
            });
        }

        Schema::table('tradesperson_professions', function (Blueprint $table){
            //$table->foreign('tradesperson_id')->references('id')->on('tradespersons')->onDelete('cascade');
            //$table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
            $table->foreignId('tradesperson_id')->constrained('tradespersons');
            $table->foreignId('profession_id')->constrained('professions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tradesperson_professions');
    }
};
