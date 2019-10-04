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
            'name' => "Gabriel Brunet",
            'email' => 'g.brunet96@gmail.com',
            'password' => bcrypt('q1w2e3r4t5y6'),
            'type' => 'ad',
        ]);
    }
}
