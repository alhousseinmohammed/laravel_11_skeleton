<?php

namespace Database\Seeders;

use App\Models\Store\Store;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::factory()->create();
    }
}
