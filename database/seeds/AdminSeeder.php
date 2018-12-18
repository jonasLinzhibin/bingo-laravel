<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Admin::class,20)->create([
            'password' => bcrypt('123456')
        ]);
        $user = \App\Models\Admin::find(1);
        $user->name = 'admin';
        $user->email ='admin@admin.com';
        $user->is_super = true;
        $user->save();

        $user = \App\Models\Admin::find(2);
        $user->name = 'admin555';
        $user->email ='admin555@admin.com';
        $user->save();
    }
}
