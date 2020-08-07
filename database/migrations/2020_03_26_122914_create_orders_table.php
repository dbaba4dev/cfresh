<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('employee_id')->nullable();
            $table->integer('admin_id')->default(0);
            $table->string('user_email');
            $table->string('name');
            $table->string('address');
            $table->string('lga');
            $table->string('state');
            $table->string('pincode')->nullable();
            $table->string('mobile');
            $table->float('balance')->nullable();
            $table->float('amount_paid')->nullable();
            $table->string('coupon_code');
            $table->float('coupon_amount');
            $table->float('grand_total');
            $table->string('order_status');
            $table->string('payment_method');
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
        Schema::dropIfExists('orders');
    }
}
