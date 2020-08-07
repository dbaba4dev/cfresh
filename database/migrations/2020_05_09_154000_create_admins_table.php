<?php

use App\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('employee_id')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Admin::create([
            'employee_id' => '1',
            'username' => 'dbaba',
            'password' => md5('funken'),
            'status' => '1'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
