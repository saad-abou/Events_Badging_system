<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('jour')->nullable();
            $table->string('heure')->nullable();
            $table->integer('totalPlace')->nullable();
            $table->integer('reserve')->nullable();
            $table->integer('track')->nullable();
            $table->string('sujet')->nullable();
            $table->string('d_seance')->nullable();
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
        Schema::dropIfExists('seances');
    }
}
