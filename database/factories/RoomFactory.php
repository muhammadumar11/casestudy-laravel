<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->name(),
            'hotel_id' => $this->faker->randomDigitNotZero(),
            'net_price' => $this->faker->numberBetween(100, 5000),
            'tax_price' => $this->faker->numberBetween(100, 5000),
            'tax_type' => $this->faker->name(),
            'tax_currency' => $this->faker->currencyCode(),
            'total_price' => $this->faker->numberBetween(100, 5000),
        ];
    }
}
