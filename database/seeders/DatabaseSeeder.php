<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
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

    \App\Models\Category::factory()->create([
      "name" => "Electronics"
    ]);

    \App\Models\Category::factory()->create([
      "name" => "Fashion"
    ]);

    \App\Models\Category::factory()->create([
      "name" => "Sport"
    ]);

    \App\Models\Category::factory()->create([
      "name" => "Beauty"
    ]);

    \App\Models\Category::factory()->create([
      "name" => "Books"
    ]);

    \App\Models\Category::factory()->create([
      "name" => "Music"
    ]);

    \App\Models\Category::factory()->create([
      "name" => "Toys"
    ]);

    \App\Models\Category::factory()->create([
      "name" => "Other"
    ]);
  }
}
