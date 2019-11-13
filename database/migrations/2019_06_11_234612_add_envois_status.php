<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnvoisStatus extends Migration
{

    public function up()
    {
        Schema::table('envois', function (Blueprint $table) {
            $table->string('status')->nullable();
        });
    }

    public function down()
    {
        Schema::table('envois', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
