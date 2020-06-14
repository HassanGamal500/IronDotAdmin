<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administration')->insert([
            'name' => 'ironDot',
            'phone' => '01270000019',
            'email' => 'irondot@gmail.com',
            'image' => '/images/user/avatar_user.png',
            'password' => bcrypt('admin123')
        ]);
    }
}
