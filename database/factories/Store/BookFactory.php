<?php

namespace Database\Factories\Store;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store\Book;
use App\Models\Store\Store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'store_id' => Store::factory(),
            'name' => $this->faker->name(),
            'barcode' => $this->faker->text(20),
            'pages_number' => $this->faker->numberBetween(5, 500),
            'published' => $this->faker->boolean(),
        ];
    }
}
