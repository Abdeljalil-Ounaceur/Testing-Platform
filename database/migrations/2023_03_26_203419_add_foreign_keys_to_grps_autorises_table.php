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
        Schema::table('grps_autorises', function (Blueprint $table) {
            $table->foreign(['idTest'], 'fk_grps_autorises_test')->references(['idTest'])->on('tests')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['idGroupe'], 'fk_grps_autorises_groupe')->references(['idGroupe'])->on('groupes')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grps_autorises', function (Blueprint $table) {
            $table->dropForeign('fk_grps_autorises_test');
            $table->dropForeign('fk_grps_autorises_groupe');
        });
    }
};
