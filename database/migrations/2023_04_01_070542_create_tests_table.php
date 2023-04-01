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
    Schema::create('tests', function (Blueprint $table) {
      $table->integer('idTest', true);
      $table->integer('idAdmin')->index('fk_test_utilisateur');
      $table->string('titre', 40);
      $table->integer('duree_mins');
      $table->string('description', 500)->nullable();
      $table->unsignedInteger('password')->nullable();
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
    Schema::dropIfExists('tests');
  }
};
