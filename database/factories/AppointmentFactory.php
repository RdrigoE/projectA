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

        $start = $this->faker->dateTimeBetween('07:00', '10:00');
        $end = $this->faker->dateTimeBetween('11:00', '20:00');

        return [
            'user_id' => User::factory(),
            'job_id' => Job::factory(),
            'client_id' => Client::factory(),
            'date' => $this->faker->dateTimeThisYear()->format('d-m-Y'),
            'start' => $start->format('H:i'),
            'end' => $end->format('H:i'),
        ];
    }
}
