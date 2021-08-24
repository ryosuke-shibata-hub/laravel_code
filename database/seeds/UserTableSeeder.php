<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

            User::create([
                'username' => '管理者',
                'email' => 'user_addmin@address.com',
                'password' => Hash::make('123456789'),
                'admin_role' => '1',

            ]);


    }
}
