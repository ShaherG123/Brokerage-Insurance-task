<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert([
            'email' => 'admin@brokerage-insurance.com',
        ],[
            'name' => 'mahmoud',
            'password' => Hash::make('admin'),
            'type' => 'admin',
        ]);
    }
}
