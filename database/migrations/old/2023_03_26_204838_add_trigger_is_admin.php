<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
    DB::unprepared("CREATE TRIGGER `insert_admin_or_candidat` AFTER INSERT ON `users` FOR EACH ROW
BEGIN
  IF NEW.isAdmin = 1 THEN
    INSERT INTO admins(idUser) VALUES (NEW.id);
  ELSE
    INSERT INTO candidats(idUser) VALUES (NEW.id);
  END IF;
END;");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::unprepared('DROP TRIGGER IF EXISTS `insert_admin_or_candidat`');
  }
};
