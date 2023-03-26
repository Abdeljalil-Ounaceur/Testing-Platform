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
        Schema::create('a_passe', function (Blueprint $table) {
            $table->integer('idCandidat');
            $table->integer('idTest')->index('fk_a_passe_test_0');
            $table->integer('idResultat')->index('fk_a_passe_resultat');

            $table->primary(['idCandidat', 'idTest', 'idResultat']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('a_passe');
    }
};
