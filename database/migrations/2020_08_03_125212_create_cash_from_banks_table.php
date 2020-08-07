<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashFromBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_from_banks', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->double('amount',15,2);
            $table->string('balance')->default(0);
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
        Schema::dropIfExists('cash_from_banks');
    }
}
