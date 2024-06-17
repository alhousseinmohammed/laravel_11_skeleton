<?php

namespace Database\Factories\Store;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store\Store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Store>
 */
class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email()
        ];
    }
}
