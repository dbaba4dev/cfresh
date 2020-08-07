<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tem_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->float('amount',12,2);
            $table->float('expense', 12,2)->default(0);
            $table->float('balance', 12, 2)->default(0);
//            $table->text('description');
//            $table->string('employee');
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
        Schema::dropIfExists('tem_accounts');
    }
}
