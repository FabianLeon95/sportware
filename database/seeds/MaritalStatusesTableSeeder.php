<?php

use Illuminate\Database\Seeder;

class MaritalStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MaritalStatus::create([
            'status' => 'Single'
        ]);
        \App\Models\MaritalStatus::create([
            'status' => 'Married'
        ]);
        \App\Models\MaritalStatus::create([
            'status' => 'Divorced'
        ]);
        \App\Models\MaritalStatus::create([
            'status' => 'Widowed'
        ]);
    }
}
