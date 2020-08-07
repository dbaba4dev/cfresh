<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->string('batch_name');
            $table->float('amount',12,2);
            $table->string('material');  //type of material
            $table->integer('no_bags');
            $table->float('kg_per_bags');
            $table->float('total_kg');
            $table->float('unit_g');
            $table->integer('tot_materials');
            $table->integer('no_materials');  //no of material per bag
            $table->string('company')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('batch_histories');
    }
}
