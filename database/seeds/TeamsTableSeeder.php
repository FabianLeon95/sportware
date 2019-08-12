<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Team::create([
            'name' => 'Bulldogs',
            'location' => 'San Jose'
        ]);
    }
}
