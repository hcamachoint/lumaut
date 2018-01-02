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
         DB::table('users')->insert([
             'name' => 'Administrador',
             'email' => 'admin@localhost.dev',
             'password' => app('hash')->make('admin'),
             'api_token' => str_random(128),
         ]);
     }
}
