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
        Schema::table('a_passe', function (Blueprint $table) {
            $table->foreign(['idTest'], 'fk_a_passe_test_0')->references(['idTest'])->on('test')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['idCandidat'], 'fk_a_passe_candidat')->references(['idCandidat'])->on('candidat')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('a_passe', function (Blueprint $table) {
            $table->dropForeign('fk_a_passe_test_0');
            $table->dropForeign('fk_a_passe_candidat');
        });
    }
};
