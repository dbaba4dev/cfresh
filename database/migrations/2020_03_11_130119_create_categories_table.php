<?php

use App\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('payment_id');
            $table->float('amount')->default(0)->nullable();
            $table->timestamps();
        });

        Category::create([
            'name' => 'Sales Rep.',
            'payment_id' => '1'
        ]);

        Category::create([
            'name' => 'Driver',
             'payment_id' => '2'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
