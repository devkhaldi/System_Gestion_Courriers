<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignEnvois extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('envois', function (Blueprint $table) {
            $table->bigInteger('service_id')->unsigned() ;
            $table->foreign('service_id')->references('id')->on('services');

            $table->bigInteger('courrier_id')->unsigned()->nullable() ;
            $table->foreign('courrier_id')->references('id')->on('courriers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('envois', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id') ;

            $table->dropForeign(['courrier_id']);
            $table->dropColumn('courrier_id') ;


        });
    }
}
