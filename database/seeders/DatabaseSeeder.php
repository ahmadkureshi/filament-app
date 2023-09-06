<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory()->create([
            "name" => "Admin",
            "email" => "admin@test.com",
            "password" => bcrypt("12345678"),
        ]);

        Certificate::create([
            "name" => "Drawing Certificate",
            "description" => "Awarded for drawing",
        ]);

        Certificate::create([
            "name" => "Singing Certificate",
            "description" => "Awarded for singing",
        ]);

        Certificate::create([
            "name" => "Quiz Certificate",
            "description" => "Awarded for passing quiz",
        ]);

        Student::factory(10)
            ->has(Guardian::factory()->count(3))
            ->create();
        $this->call(StandardSeeder::class);
    }
}
