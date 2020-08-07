<?php

use App\Box;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('case');
            $table->double('price',10,2);
            $table->float('preform_g');
            $table->float('cap_g')->default(0);
            $table->float('label_g')->default(0);
            $table->integer('cap_no')->default(0);
            $table->integer('label_no')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Box::create([
            'case' => '50 cl.',
            'price' => 500,
            'preform_g' => 16,
            'cap_g' => 0.6,
            'label_g' => .2,
            'description' => 'Conventional 50cl case '
        ]);

        Box::create([
            'case' => '75 cl.',
            'price' => 600,
            'preform_g' => 18,
            'cap_g' => 0.6,
            'label_g' => .2,
            'description' => 'Conventional 75cl case '
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxes');
    }
}
