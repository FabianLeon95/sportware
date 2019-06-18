<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Position::create([
            'position_name'=>'Quarterback',
        ]);
        \App\Models\Position::create([
            'position_name'=>'Position 2',
        ]);
        \App\Models\Position::create([
            'position_name'=>'Position 3',
        ]);
    }
}
