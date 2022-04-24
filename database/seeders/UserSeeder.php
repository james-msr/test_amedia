<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Manager',
            'last_name' => 'Admin',
            'phone' => '+998901112233',
            'email' => 'manager@admin.com',
            'password' => Hash::make('password'),
            'gender' => User::GENDER['male'],
            'role' => User::ROLE['manager'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
