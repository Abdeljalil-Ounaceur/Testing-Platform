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
        Schema::create('grps_autorises', function (Blueprint $table) {
            $table->integer('idGroupe');
            $table->integer('idTest')->index('fk_grps_autorises_test');

            $table->primary(['idGroupe', 'idTest']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grps_autorises');
    }
};
