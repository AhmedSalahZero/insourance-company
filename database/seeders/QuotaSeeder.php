<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Quota;
use Illuminate\Database\Seeder;

class QuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quota = Quota::factory()->create();

        $quota->features()->save(
            Feature::factory()->make()
        );


        $quota->features()->save(
            Feature::factory()->make()
        );


    }
}
