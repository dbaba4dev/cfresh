<?php

use App\Customer;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer1 =  Customer::create([
            'name'=>'Ibrahim Isa',
            'employee_id' => '1',
            'customer_category_id' => '1',
            'area_id' => '1',
            'credit_limit' => '2000'
        ]);

        Profile::create([
            'customer_id'=>$customer1->id,
            'avatar'=>'uploads/customers/avatar2.png',
            'address'=>'Gomari Airport. Maiduguri, Nigeria.',
            'phone'=>'08031114400'
        ]);

        $customer2 =  Customer::create([
            'name'=>'Yakubu Musa',
            'employee_id' => '2',
            'customer_category_id' => '2',
            'area_id' => '1',
            'credit_limit' => '3000'
        ]);

        Profile::create([
            'customer_id'=>$customer2->id,
            'avatar'=>'uploads/customers/avatar2.png',
            'address'=>'London Jiki. Maiduguri, Nigeria.',
            'phone'=>'08033224400'
        ]);
    }
}
