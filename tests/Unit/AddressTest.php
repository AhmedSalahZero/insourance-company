<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address ; 

class AddressTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_belongs_to_one_user()
    {
        $user=User::factory()->create();

        $address = Address::factory()->create([
            'user_id'=>1
        ]);
        
        $this->assertInstanceOf(User::class , $address->user);
    }

    public function test_it_updates_address_if_auth_user()
    {
        $user = User::factory()->create() ;

        $user->addresses()->save(
           $address =  Address::factory()->create([
               'user_id'=>$user->id 
           ])
        );

        $address->update([
            'name'=>$name = 'ahmed',

            'street'=>$street = '123 street',

        ]);

        $this->actingAs($user);

        $this->assertDataBaseHas('addresses',[
            'name'=>$name , 
            'street'=>$street , 
        ]);
        
    }

}
