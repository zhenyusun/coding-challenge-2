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
        /**
         * INSERT 'test' USER TO THE DATABASE
         */
        DB::table('users')
            ->updateOrInsert(
                ['id' => 1],
                [
                    'id' => 1,
                    'name' => 'bob test',
                    'email' => 'test@example.com',
                    'password' => bcrypt('secret')
                ]
            );
    }
}
