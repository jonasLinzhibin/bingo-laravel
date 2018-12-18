<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,20)->create([
            'password' => bcrypt('123456')
        ]);
        $user = \App\User::find(1);
        $user->name = 'jonas888';
        $user->email ='jonas888@admin.com';
        $user->save();

        $user = \App\User::find(2);
        $user->name = 'jonas555';
        $user->email ='jonas555@admin.com';
        $user->save();
    }
}
