<?php

use App\Profile;
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('admin')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('address')->nullable();
            $table->float('old_balance')->nullable();
            $table->string('lga_id',100)->nullable();
            $table->string('state_id',100)->nullable();
            $table->string('pincode',100)->nullable();
            $table->string('mobile',100)->nullable();
            $table->string('company_name',100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
