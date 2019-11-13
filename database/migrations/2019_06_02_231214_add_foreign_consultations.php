<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignConsultations extends Migration
{
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned() ;
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('courrier_id')->unsigned()->nullable() ;
            $table->foreign('courrier_id')->references('id')->on('courriers');
        });
    }
    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id') ;
            $table->dropForeign(['courrier_id']);
            $table->dropColumn('courrier_id') ;
        });
    }
}
