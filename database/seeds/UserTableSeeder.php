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

        //     for ($i = 1; $i <= 5; $i++) {

        //     User::create([
        //         'username' => 'testUser'.$i,
        //         'email' => 'user@address.com'.$i,
        //         'password' => Hash::make('123456789'),
        //         'admin_role' => '10',
        //     ]);

        // }

    }
}
