<?php

use App\Employee;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee1 =  Employee::create([
            'name'=>'Dauda Baba',
            'account_no' => '00123459090',
            'account_name' => 'Dauda Baba',
            'bank_id' => 3,
            'target' => 0,
            'category_id' => 1,
            'joined' =>Carbon::parse('11/04/2011')->toDateTimeString()
        ]);

        Profile::create([
            'employee_id'=>$employee1->id,
            'avatar'=>'uploads/avatars/dbaba.jpg',
            'address'=>'Bulabulin Ganaram. Maiduguri, Nigeria.',
            'phone'=>'08037520570'
        ]);

        $employee2 =  Employee::create([
            'name'=>'Man Musa',
            'account_no' => '00443459090',
            'account_name' => 'Man Musa',
            'bank_id' => 7,
            'target' => 0,
            'category_id' => 1,
            'joined' =>Carbon::parse('2/04/2012')->toDateTimeString()
        ]);

        Profile::create([
            'employee_id'=>$employee2->id,
            'avatar'=>'uploads/avatars/avatar5.png',
            'address'=>'Custom Jiki. Maiduguri, Nigeria.',
            'phone'=>'08022224400'
        ]);

        $employee3 =  Employee::create([
            'name'=>'Yahaya Isa',
            'account_no' => '00123459090',
            'account_name' => 'Yahaya Isa',
            'bank_id' => 3,
            'target' => 0,
            'category_id' => 2,
            'joined' =>Carbon::parse('2/04/2010')->toDateTimeString()
        ]);

        Profile::create([
            'employee_id'=>$employee3->id,
            'avatar'=>'uploads/avatars/avatar5.png',
            'address'=>'Bulabulin Ganaram. Maiduguri, Nigeria.',
            'phone'=>'08037524400'
        ]);
    }
}
