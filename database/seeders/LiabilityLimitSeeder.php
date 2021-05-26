<?php

namespace Database\Seeders;

use App\Models\LiabilityLimit;
use Illuminate\Database\Seeder;

class LiabilityLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiabilityLimit::factory()->create();
    }
}
