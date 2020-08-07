<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name'=>'Dauda Baba',
            'admin'=>true,
            'email'=>'deebaba4u@gmail.com',
            'password'=>bcrypt('Funken3531'),
            'status'=>1,
        ]);

        Profile::create([
            'user_id'=>$user1->id,
            'avatar'=>'images/users/dbaba.png',
            'address'=>'36 Ngorgi Street, Hausari Ward. Maiduguri, Nigeria.',
            'phone'=>'08037520000'
        ]);

        $user2 = User::create([
            'name'=>'Mustapha Hussaini',
            'admin'=>true,
            'email'=>'musty@gmail.com',
            'password'=>bcrypt('023573@che'),
            'status'=>1,
        ]);

        Profile::create([
            'user_id'=>$user2->id,
            'avatar'=>'images/users/avatar.png',
            'address'=>'Jajeri Polo. Maiduguri, Nigeria.',
            'phone'=>'08037520000'
        ]);
    }
}
