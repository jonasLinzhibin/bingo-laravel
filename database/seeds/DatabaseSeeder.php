<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(PostsConfigsSeeder::class);
        $this->call(PostsCategorySeeder::class);
        $this->call(CommentSeeder::class);
    }
}
