<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Sections::class, 15)->create();
        $this->call(UsersTableSeeder::class);
        factory(\App\User::class, 15)->create();
        factory(\App\UsersSectionsRelationships::class, 30)->create();
    }
}
