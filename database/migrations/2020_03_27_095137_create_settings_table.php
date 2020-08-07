<?php

use App\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('contact_number');
            $table->string('contact_email');
            $table->string('contact_address');
//            $table->float('bag_price');
            $table->float('commission_factor');
            $table->boolean('close')->default(0);
            $table->timestamps();
        });

        Setting::create([
            'site_name' =>"C-fresh's and Co.",
            'contact_address' =>"Maiduguri, Borno State",
            'contact_number' =>"08022775600",
            'contact_email' =>"info@bahrnoor.com",
            'commission_factor' =>5.00,
//            'bag_price' =>45
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
