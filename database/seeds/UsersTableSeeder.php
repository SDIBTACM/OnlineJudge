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
        factory(App\Models\User::class, 20)->create();
        factory(App\Models\User::class, 5)->states('teacher')->create();
        factory(App\Models\User::class, 3)->states('admin')->create();
    }
}
