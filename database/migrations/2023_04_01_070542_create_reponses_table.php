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
    Schema::create('reponses', function (Blueprint $table) {
      $table->integer('idReponse', true);
      $table->integer('idQuestion')->index('fk_reponse_question_0');
      $table->integer('numReponse');
      $table->boolean('estCorrecte');
      $table->string('text', 100);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('reponses');
  }
};
