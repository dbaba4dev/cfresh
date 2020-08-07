<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caps', function (Blueprint $table) {
            $table->id();
            $table->integer('no_bags');
            $table->float('kg_per_bag');
            $table->float('total_kg');
            $table->float('cap_g');
            $table->integer('tot_cap');
            $table->integer('no_cap');
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
        Schema::dropIfExists('caps');
    }
}
