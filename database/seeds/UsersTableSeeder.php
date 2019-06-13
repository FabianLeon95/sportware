<?php

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
        \App\Models\User::create([
            'role_id'=> 1,
            'name' => 'Fabián León',
            'email'=>'fabian30leon@gmail.com',
            'password'=>bcrypt('fLc.3008')
        ]);
    }
}
