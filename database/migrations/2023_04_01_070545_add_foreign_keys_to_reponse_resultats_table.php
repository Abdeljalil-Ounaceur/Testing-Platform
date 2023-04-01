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
    Schema::table('reponse_resultats', function (Blueprint $table) {
      $table->foreign(['idReponse'], 'fk_reponce_resultat_reponse_0')->references(['idreponse'])->on('reponses')->onUpdate('CASCADE')->onDelete('CASCADE');
      $table->foreign(['idResultat'], 'fk_reponce_resultat_resultat')->references(['idResultat'])->on('resultats')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('reponse_resultats', function (Blueprint $table) {
      $table->dropForeign('fk_reponce_resultat_reponse_0');
      $table->dropForeign('fk_reponce_resultat_resultat');
    });
  }
};
