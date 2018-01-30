<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'quiz';

    /**
     * Run the migrations.
     * @table quiz
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title')->nullable()->default(null);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->text('email')->nullable()->default(null);
            $table->string('url_to')->nullable()->default(null);
            $table->integer('id_user')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->integer('id_categorie');
            $table->string('amount')->nullable()->default(null);
            $table->text('currency')->nullable()->default(null);

            $table->unique('url_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
