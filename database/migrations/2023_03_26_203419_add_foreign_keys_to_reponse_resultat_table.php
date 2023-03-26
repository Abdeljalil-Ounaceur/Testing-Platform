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
        Schema::table('reponse_resultat', function (Blueprint $table) {
            $table->foreign(['idResultat'], 'fk_reponce_resultat_resultat')->references(['idResultat'])->on('resultat')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['idReponce'], 'fk_reponce_resultat_reponse_0')->references(['idreponse'])->on('reponse')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reponse_resultat', function (Blueprint $table) {
            $table->dropForeign('fk_reponce_resultat_resultat');
            $table->dropForeign('fk_reponce_resultat_reponse_0');
        });
    }
};
