<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = Carbon::now();
        return [
            'user_id' => User::factory(),
            'job_id' => Job::factory(),
            'client_id' => Client::factory(),
            'start' => $date,
            'end' => $date->addHours(4),
        ];
    }
}
