<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User ; 
use App\Models\Address;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>'admin',
        ]);
        Address::factory()->create([
            'user_id'=>$user->id , 
        ]);
        Address::factory()->create([
            'user_id'=>$user->id , 
        ]);
    }
}
