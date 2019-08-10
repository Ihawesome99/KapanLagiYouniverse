<?php

use Illuminate\Database\Seeder;
use App\User;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email','admin@admin.com')->first()) {
            User::create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
                'name' => 'Administrator'
            ]);
        }
    }
}
