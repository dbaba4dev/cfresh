<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->integer('no_bags');
            $table->float('kg_per_bag');
            $table->float('total_kg');
            $table->float('label_g');
            $table->integer('tot_label');
            $table->integer('no_label');
            $table->integer('box_id');
            $table->string('company')->nullable();
            $table->boolean('open')->default(0);
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
        Schema::dropIfExists('labels');
    }
}
