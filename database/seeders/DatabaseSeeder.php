<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user_1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user_2 = User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test_2@example.com',
        ]);

        Job::factory(14)->create([
            'user_id' => $user_1->id,
        ]);


        Job::factory()->create([
            'user_id' => $user_1->id,
            'title' => 'The same title'
        ]);

        Job::factory()->create([
            'user_id' => $user_2->id,
            'title' => 'The same title',
        ]);

        Client::factory(20)->create([
            'user_id' => $user_1->id
        ]);

        Appointment::factory(200)->create([
            'user_id' => $user_1,
        ]);
    }
}
