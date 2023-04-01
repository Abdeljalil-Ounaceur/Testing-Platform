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
        Schema::table('reponses', function (Blueprint $table) {
            $table->foreign(['idQuestion'], 'fk_reponse_question_0')->references(['idQuestion'])->on('questions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reponses', function (Blueprint $table) {
            $table->dropForeign('fk_reponse_question_0');
        });
    }
};
