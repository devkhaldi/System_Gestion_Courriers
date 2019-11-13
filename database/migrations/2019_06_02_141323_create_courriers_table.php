<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courriers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num') ;
            $table->string('type')->nullable() ;
            $table->string('titre') ;
            $table->longText('objet') ;
            $table->string('fichier') ;
            $table->string('status') ;
            $table->string('emetteur') ;
            $table->datetime('deleted_at')->nullable() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courriers');
    }
}
