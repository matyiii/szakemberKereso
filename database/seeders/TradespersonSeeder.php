<?php

namespace Database\Seeders;

use App\Models\Tradesperson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TradespersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tradesperson::factory()->count(5)->create();
    }
}
