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
        Schema::table('groupe', function (Blueprint $table) {
            $table->foreign(['idAdmin'], 'fk_groupe_admin')->references(['idAdmin'])->on('admin')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groupe', function (Blueprint $table) {
            $table->dropForeign('fk_groupe_admin');
        });
    }
};
