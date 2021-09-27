<?php

namespace Database\Seeders;

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
        DB::table('users')->truncate();

        DB::table('users')->insert([
                'name'     => 'Demo Admin',
                'email'    => 'admin@blog.com',
                'password' => bcrypt('admin1'),
                'is_admin' => 1,
            ]);
    }
}
