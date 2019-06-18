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
            'position_name'=>'Running Back',
        ]);
        \App\Models\Position::create([
            'position_name'=>'Fullback',
        ]);
    }
}
