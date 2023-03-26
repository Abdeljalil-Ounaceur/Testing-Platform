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
        Schema::table('membre_de_groupe', function (Blueprint $table) {
            $table->foreign(['idGroupe'], 'fk_membre_de_groupe_groupe_0')->references(['idGroupe'])->on('groupe')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['idCandidat'], 'fk_membre_de_groupe_candidat')->references(['idCandidat'])->on('candidat')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membre_de_groupe', function (Blueprint $table) {
            $table->dropForeign('fk_membre_de_groupe_groupe_0');
            $table->dropForeign('fk_membre_de_groupe_candidat');
        });
    }
};
