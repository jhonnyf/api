<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_types')->insert([
            'active'     => 1,
            'user_type'  => 'Root',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
