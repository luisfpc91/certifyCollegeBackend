<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_results', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_test');
            $table->integer('id_quiz');
            $table->integer('id_question');
            $table->integer('id_answer');
            $table->string('total')->nullable()->default(null);
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db_results');
    }
}
