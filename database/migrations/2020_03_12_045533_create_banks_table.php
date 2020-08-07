<?php

use App\Bank;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Bank::create([
            'name' => 'ACCESS BANK PLC'
        ]);
        Bank::create([
            'name' => 'CITIBANK NIGERIA LIMITED'
        ]);
        Bank::create([
            'name' => 'CORONATION MERCHANT BANK'
        ]);
        Bank::create([
            'name' => 'ECOBANK NIGERIA PLC'
        ]);
        Bank::create([
            'name' => 'FBN HOLDINGS PLC'
        ]);
        Bank::create([
            'name' => 'FBN MERCHANT BANK'
        ]);
        Bank::create([
            'name' => 'FCMB GROUP PLC'
        ]);
        Bank::create([
            'name' => 'FIDELITY BANK PLC'
        ]);
        Bank::create([
            'name' => 'FIRST BANK NIGERIA LIMITED'
        ]);
        Bank::create([
            'name' => 'FIRST CITY MONUMENT BANK PLC'
        ]);
        Bank::create([
            'name' => 'FSDH MERCHANT BANK'
        ]);
        Bank::create([
            'name' => 'GUARANTY TRUST BANK PLC'
        ]);
        Bank::create([
            'name' => 'HERITAGE BANK LIMITED'
        ]);
        Bank::create([
            'name' => 'JAIZ BANK PLC'
        ]);
        Bank::create([
            'name' => 'KEYSTONE BANK LIMITED'
        ]);
        Bank::create([
            'name' => 'NOVA MERCHANT BANK'
        ]);
        Bank::create([
            'name' => 'POLARIS BANK PLC'
        ]);
        Bank::create([
            'name' => 'PROVIDUS BANK PLC'
        ]);
        Bank::create([
            'name' => 'RAND MERCHANT BANK'
        ]);
        Bank::create([
            'name' => 'STANBIC IBTC BANK PLC'
        ]);
        Bank::create([
            'name' => 'STANBIC IBTC HOLDINGS PLC'
        ]);
        Bank::create([
            'name' => 'STANDARD CHARTERED BANK LTD.'
        ]);
        Bank::create([
            'name' => 'STERLING BANK PLC'
        ]);
        Bank::create([
            'name' => 'SUNTRUST BANK NIGERIA LIMITED'
        ]);
        Bank::create([
            'name' => 'UNION BANK OF NIGERIA PLC'
        ]);
        Bank::create([
            'name' => 'UNITED BANK OF AFRICA PLC'
        ]);
        Bank::create([
            'name' => 'UNITY BANK PLC'
        ]);
        Bank::create([
            'name' => 'WEMA BANK PLC'
        ]);
        Bank::create([
            'name' => 'ZENITH BANK PLC'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
