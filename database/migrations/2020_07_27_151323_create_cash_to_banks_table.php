<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashToBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_to_banks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('amount',15,2);
            $table->string('teller')->nullable();
            $table->date('move_date');
            $table->string('bank');
            $table->string('account_name');
            $table->string('account_no');
            $table->text('description');
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
        Schema::dropIfExists('cash_to_banks');
    }
}
