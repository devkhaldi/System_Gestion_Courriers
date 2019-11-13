<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// TYPE USER :  ADMIN OR EMPLOYEE OR SERVICE CHEF


class AddUsersCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cin')->nullable() ;
            $table->string('photo')->nullable() ;
            $table->string('type')->nullable() ;
            $table->datetime('deleted_at')->nullable() ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cin') ;
            $table->dropColumn('photo') ;
            $table->dropColumn('type') ;
            $table->dropColumn('deleted_at') ;
        });
    }
}
