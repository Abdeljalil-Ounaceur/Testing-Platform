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
    Schema::table('tests', function (Blueprint $table) {
      $table->foreign(['idAdmin'], 'fk_test_utilisateur')->references(['id'])->on('utilisateurs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('tests', function (Blueprint $table) {
      $table->dropForeign('fk_test_utilisateur');
    });
  }
};
