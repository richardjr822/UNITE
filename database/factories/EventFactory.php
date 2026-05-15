<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'date' => now()->addDays(fake()->numberBetween(1, 20))->toDateString(),
            'time' => fake()->time('H:i'),
            'venue' => fake()->streetName(),
            'capacity' => fake()->numberBetween(10, 200),
            'status' => 'scheduled',
        ];
    }

    public function cancelled(): static
    {
        return $this->state(fn () => ['status' => 'cancelled']);
    }
}
