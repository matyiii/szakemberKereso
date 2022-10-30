<?php

namespace Database\Seeders;

use App\Models\Profession;
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
        $tp = Tradesperson::factory()->count(20)->create();
        $professions = Profession::all();
        Tradesperson::all()->each(function ($user) use ($professions){
            $user->professionsTp()->attach(
                [$user->id => ['profession_id' => $professions->random(1)->pluck('id')->first()]]
            );
        });
    }
}
