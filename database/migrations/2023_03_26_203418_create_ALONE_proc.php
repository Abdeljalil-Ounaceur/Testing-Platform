<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `ALONE`()
          BEGIN
            alter table admin auto_increment = 1;
            alter table candidat auto_increment = 1;
            alter table groupe auto_increment = 1;
            alter table grps_autorises auto_increment = 1;
            alter table membre_de_groupe auto_increment = 1;
            alter table question auto_increment = 1;
            alter table reponse auto_increment = 1;
            alter table reponse_resultat auto_increment = 1;
            alter table resultat auto_increment = 1;
            alter table test auto_increment = 1;
            alter table utilisateur auto_increment = 1;
          END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ALONE");
    }
};
