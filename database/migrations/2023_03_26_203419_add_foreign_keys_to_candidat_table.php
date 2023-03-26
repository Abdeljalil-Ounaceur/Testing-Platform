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
        Schema::table('candidat', function (Blueprint $table) {
            $table->foreign(['idUtilisateur'], 'fk_candidat_utilisateur')->references(['id'])->on('utilisateur')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidat', function (Blueprint $table) {
            $table->dropForeign('fk_candidat_utilisateur');
        });
    }
};
