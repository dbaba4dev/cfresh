<?php

use App\CustomerCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('discount',10,2)->default(0);
            $table->timestamps();
        });

        CustomerCategory::create([
            'name' => 'Regional Dealer'
        ]);
        CustomerCategory::create([
            'name' => 'Local Dealer'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_categories');
    }
}
