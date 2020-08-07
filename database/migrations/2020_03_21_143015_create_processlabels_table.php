<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesslabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processlabels', function (Blueprint $table) {
            $table->id();
//            $table->integer('no_bags')->default(0);
            $table->integer('box_id')->default(0);
            $table->float('kg_bags')->default(0);
            $table->integer('no_label')->default(0);
            $table->float('label_damages')->default(0);
            $table->float('label_g')->default(0);
            $table->boolean('is_open')->default(0);
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
        Schema::dropIfExists('processlabels');
    }
}
