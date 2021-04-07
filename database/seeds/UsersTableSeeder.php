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
            'name' => 'Nguyễn An Khang',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 1
        ]);
    }
}
