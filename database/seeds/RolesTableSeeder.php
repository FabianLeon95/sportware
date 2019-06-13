<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
            'role_name'=>'admin',
            'display_name'=>'Administrador'
        ]);
        \App\Models\Role::create([
            'role_name'=>'stats',
            'display_name'=>'Estadisticas'
        ]);
        \App\Models\Role::create([
            'role_name'=>'player',
            'display_name'=>'Jugador'
        ]);
    }
}
