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
    Schema::create('resultats', function (Blueprint $table) {
      $table->integer('idResultat', true);
      $table->integer('idCandidat')->index('fk_resultat_utilisateur');
      $table->integer('idTest')->index('fk_resultat_test');
      $table->decimal('score', 4);
      $table->integer('duree');
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
    Schema::dropIfExists('resultats');
  }
};
