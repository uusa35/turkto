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
        if (app()->environment('local')) {
            DB::table('users')->truncate();
            $this->call(UsersTableSeeder::class);
        }

    }
}
