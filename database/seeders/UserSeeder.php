<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
   $user = User::create([
          'name' =>'Admin',
          'email' =>'admin@admin.com',
          'email_verified_at' => now(),
          'password' =>Hash::make('12345678'),
          'phone_number' =>'0102525023',
          'role'=>'super admin',
          'remember_token' => Str::random(10),
   ]);
   $user->assignRole('super_admin');
  }
}
