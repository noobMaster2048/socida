<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Konan',
            'last_name' => 'Wilfried franck hervé',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('admin1234'),
        ]);
    }
}
