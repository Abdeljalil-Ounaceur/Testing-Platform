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
    Schema::create('reponse_resultats', function (Blueprint $table) {
      $table->integer('idResultat')->index('fk_reponce_resultat_resultat');
      $table->integer('idReponse')->index('fk_reponce_resultat_reponse_0');

      $table->primary(['idResultat', 'idReponse']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('reponse_resultats');
  }
};
