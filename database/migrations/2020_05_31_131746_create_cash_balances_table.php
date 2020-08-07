<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_balances', function (Blueprint $table) {
            $table->id();
            $table->float('daily_income');
            $table->float('daily_expense');
            $table->float('balance')->default(0);
            $table->float('new_balance')->default(0);
            $table->date('cash_date');
            $table->string('description')->nullable();
            $table->string('question')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('cash_balances');
    }
}
