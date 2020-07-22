<?php

use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('login')->insert([
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'description' => 'Usuario Administrador'
        ]);

        DB::table('login')->insert([
            'login' => 'user',
            'password' => Hash::make('user'),
            'description' => 'Usuario genérico'
        ]);
    }
}
