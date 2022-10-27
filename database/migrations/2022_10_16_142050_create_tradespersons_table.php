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
        Schema::create('tradespersons', function (Blueprint $table){
            $table->id();
            $table->string('firstname',30);
            $table->string('lastname',30);
            $table->foreignId('addressId')->constrained('addresses');
            $table->text('introduction')->nullable();
            $table->tinyInteger('highlighted')->default(0);
            //$table->date('startDate')->nullable();
            //$table->date('endDate')->nullable();
            $table->integer('ratingSum')->default(0);
            $table->integer('ratingCount')->default(0);
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradespersons',function (Blueprint $table){
            $table->dropForeign('tradespersons_addressId_foregin');
        });//kell?
        Schema::dropIfExists('tradespersons');
    }
};
