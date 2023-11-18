<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
  public function run(): void {
    \App\Models\User::factory(10)->create();
    \App\Models\User::create([
      'name' => 'lzcdr',
      'email' => 'lzcdr@gmail.com',
      'phone' => '081234567890',
      'roles' => 'ADMIN',
      'password' => Hash::make('horehore'),
  ]);
  }
}