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
        Schema::create('membre_de_groupe', function (Blueprint $table) {
            $table->integer('idCandidat');
            $table->integer('idGroupe')->index('fk_membre_de_groupe_groupe_0');
            $table->boolean('en_attente')->default(true);

            $table->primary(['idCandidat', 'idGroupe']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membre_de_groupe');
    }
};
