<?php

use Illuminate\Database\Seeder;

class FoulsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Foul::create([
            'description' => 'Block in the back',
            'distance' => 10
        ]);
        \App\Models\Foul::create([
            'description' => 'Blocking below waist',
            'distance' => 15
        ]);
        \App\Models\Foul::create([
            'description' => 'Face mask',
            'distance' => 15
        ]);
        \App\Models\Foul::create([
            'description' => 'Face mask (incidental)',
            'distance' => 5
        ]);
        \App\Models\Foul::create([
            'description' => 'Unsportmanlike conduct',
            'distance' => 15
        ]);
    }
}
