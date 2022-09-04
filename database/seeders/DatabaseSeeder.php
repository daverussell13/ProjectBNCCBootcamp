<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    \App\Models\User::factory()->create([
      'email' => 'test1@gmail.com',
    ]);

    \App\Models\User::factory()->create([
      'email' => 'test2@gmail.com',
    ]);

    \App\Models\User::factory()->create([
      'email' => 'test3@gmail.com',
    ]);

    \App\Models\Admin::factory()->create([
      'admin_id' => "admin",
    ]);
  }
}
