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
    Schema::table('resultats', function (Blueprint $table) {
      $table->foreign(['idTest'], 'fk_resultat_test')->references(['idTest'])->on('tests')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      $table->foreign(['idCandidat'], 'fk_resultat_utilisateur')->references(['id'])->on('utilisateurs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('resultats', function (Blueprint $table) {
      $table->dropForeign('fk_resultat_test');
      $table->dropForeign('fk_resultat_utilisateur');
    });
  }
};
