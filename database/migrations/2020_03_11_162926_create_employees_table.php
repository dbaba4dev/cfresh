<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('name')->unique();
            $table->string('account_no')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_id')->nullable();
            $table->float('balance')->default(0);
            $table->integer('target')->default(0)->nullable();
            $table->date('joined')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
