<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesspreformsSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processpreforms_summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('box_id')->unsigned();
            $table->integer('no_preform')->default(0);
            $table->integer('no_cap')->default(0);
            $table->integer('no_label')->default(0);

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
        Schema::dropIfExists('processpreforms_summaries');
    }
}
