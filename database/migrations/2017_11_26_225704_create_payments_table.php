<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('currency');
            $table->string('amount');
            $table->text('status');
            $table->string('email');
            $table->string('payment_id');
            $table->string('payer_id');
            $table->string('token')->nullable()->default(null);
            $table->enum('status_token',['0','1']);
            $table->timestamps();

            $table->unique('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
