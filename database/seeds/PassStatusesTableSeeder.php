<?php

use Illuminate\Database\Seeder;

class PassStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PassStatus::create([
            'status' => 'comp',
            'description' => 'Complete'
        ]);
        \App\Models\PassStatus::create([
            'status' => 'incomp',
            'description' => 'Incomplete'
        ]);
        \App\Models\PassStatus::create([
            'status' => 'int',
            'description' => 'Interception'
        ]);
        \App\Models\PassStatus::create([
            'status' => 'sack',
            'description' => 'Sack'
        ]);
    }
}
