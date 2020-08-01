<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaEpisodios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temporada');
            $table->integer('numero');
            $table->string('nome', 100);
            $table->boolean('assistido')->default(false);
            $table->unsignedBigInteger('serie_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('serie_id')
                ->references('id')
                ->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodios');
    }
}
