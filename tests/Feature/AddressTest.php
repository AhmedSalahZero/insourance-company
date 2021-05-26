<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Address;

class AddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_requires_to_be_auth_to_store_address()
    {
        $this->json('post','api/address')->assertStatus(401);
    
    }
    public function test_it_does_not_requires_an_name()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'govern'=>'cairo'
        ])->assertJsonMissingValidationErrors(['name']);
    
    }

    public function test_it_requires_string_name()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'name'=>123
        ])->assertJsonValidationErrors(['name']);
    
    }

    public function test_it_fails_if_name_exceed_255_char()
    {
        $this->actingAs(User::factory()->create());
       
        $this->json('post','api/address', [
            'name'=>str_repeat('a' ,256)
        ])->assertJsonValidationErrors(['name']);
    
    }


    public function test_it_requires_an_govern()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'name'=>'new address'
        ])->assertJsonValidationErrors(['govern']);
    
    }
    
    public function test_it_requires_string_govern()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'govern'=>123
        ])->assertJsonValidationErrors(['govern']);
    
    }

    public function test_it_fails_if_govern_exceed_255_char()
    {
        $this->actingAs(User::factory()->create());
       
        $this->json('post','api/address', [
            'govern'=>str_repeat('a' ,256)
        ])->assertJsonValidationErrors(['govern']);
    
    }

    public function test_it_requires_an_area()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'govern'=>'new address'
        ])->assertJsonValidationErrors(['area']);
    
    }
    
    public function test_it_requires_string_area()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'area'=>123
        ])->assertJsonValidationErrors(['area']);
    
    }

    public function test_it_fails_if_area_exceed_255_char()
    {
        $this->actingAs(User::factory()->create());
       
        $this->json('post','api/address', [
            'area'=>str_repeat('a' ,256)
        ])->assertJsonValidationErrors(['area']);
    
    }

   
    
    public function test_it_requires_string_street()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'street'=>123
        ])->assertJsonValidationErrors(['street']);
    
    }

    public function test_it_fails_if_street_exceed_255_char()
    {
        $this->actingAs(User::factory()->create());
       
        $this->json('post','api/address', [
            'street'=>str_repeat('a' ,256)
        ])->assertJsonValidationErrors(['street']);
    
    }

   
    
    public function test_it_requires_string_building()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'building'=>123
        ])->assertJsonValidationErrors(['building']);
    
    }

    public function test_it_fails_if_building_exceed_255_char()
    {
        $this->actingAs(User::factory()->create());
       
        $this->json('post','api/address', [
            'building'=>str_repeat('a' ,256)
        ])->assertJsonValidationErrors(['building']);
    
    }

   
    
    public function test_it_requires_string_flat_number()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'flat_number'=>123
        ])->assertJsonValidationErrors(['flat_number']);
    
    }

    public function test_it_fails_if_flat_number_exceed_255_char()
    {
        $this->actingAs(User::factory()->create());
       
        $this->json('post','api/address', [
            'flat_number'=>str_repeat('a' ,256)
        ])->assertJsonValidationErrors(['flat_number']);
    
    }

    

    public function test_it_requires_floor_to_be_numeric()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'floor'=>'new address'
        ])->assertJsonValidationErrors(['floor']);
    
    }

    public function test_it_requires_floor_to_be_numeric_between_0_200()
    {
        $this->actingAs(User::factory()->create());

        $this->json('post','api/address', [
            'floor'=>201
        ])->assertJsonValidationErrors(['floor']);
    
    }

    public function test_it_passes_if_floor_no_between_0_200()
    {
        $this->actingAs(User::factory()->create());
        
        $this->json('post','api/address', [
            'floor'=>200
        ])->assertJsonMissingValidationErrors(['floor']);
    
    }
    public function test_it_not_store_an_address_if_user_not_auth()
    {
        $user = User::factory()->create();
   
        $address = Address::factory()->make([
            'user_id'=>$user->id
        ]);
        $this->json('post','api/address',[
            'name'=>$address->name , 
            'street'=>$address->street , 
            'building'=>$address->building , 
            'floor'=>$address->floor,
            'flat_number'=>$address->flat_number , 
            'user_id'=>$address->user_id , 
            'area'=>$address->area , 
            'govern'=>$address->govern,

        ])->assertStatus(401);
        
        $this->assertDataBaseMissing('addresses',[
            'name'=>$address->name , 
            'street'=>$address->street , 
            'building'=>$address->building , 
            'floor'=>$address->floor,
            'flat_number'=>$address->flat_number , 
            'user_id'=>$address->user_id , 
            'area'=>$address->area , 
            'govern'=>$address->govern,
        ]);
    }

    public function test_it_store_an_address_if_user_auth()
    {
        $user = User::factory()->create();
   
        $address = Address::factory()->make([
            'user_id'=>$user->id
        ]);

        $this->jsonAs($user , 'post','api/address',[
            'name'=>$address->name , 
            'street'=>$address->street , 
            'building'=>$address->building , 
            'floor'=>$address->floor,
            'flat_number'=>$address->flat_number , 
            'user_id'=>$address->user_id , 
            'area'=>$address->area , 
            'govern'=>$address->govern,

        ]);

        $this->assertDataBaseHas('addresses',[
            'name'=>$address->name , 
            'street'=>$address->street , 
            'building'=>$address->building , 
            'floor'=>$address->floor,
            'flat_number'=>$address->flat_number , 
            'user_id'=>$address->user_id , 
            'area'=>$address->area , 
            'govern'=>$address->govern,
        ]);
    }

    public function test_it_updates_address_if_auth()
    {
        $user = User::factory()->create() ;
        
        $address = Address::factory()->create([
            'user_id'=>$user->id 
        ]);
        

         $this->jsonAs($user , 'put' , '/api/address/'.$address->id , [
            'name'=>$name = 'ahmed',
            'street'=>$street = '123 street',
        ])->assertJsonFragment([
            "message"=>"Record Has Been Updated Successfully"
        ]);
 
        
    }
    
    public function test_it_deletes_address_if_auth()
    {
        $user = User::factory()->create() ;
        
        $address = Address::factory()->create([
            'user_id'=>$user->id 
        ]);
         $this->jsonAs($user , 'delete' , '/api/address/'.$address->id , [
            'name'=>$name = 'ahmed',

            'street'=>$street = '123 street',

        ])
        ->assertJsonFragment([
            "message"=>"Record Has Been Deleted Successfully"
        ]) ; 
        
        $this->assertDataBaseMissing('addresses' , [
            'name'=>$name ,

            'street'=>$street ,
        ]);
 
        
    }

    public function test_it_get_all_addresses_of_auth_user()
    {
        $user = User::factory()->create() ;
        
        $address = Address::factory()->create([
            'user_id'=>$user->id 
        ]);
        $address2 = Address::factory()->create([
            'user_id'=>$user->id 
        ]);
        $address3 = Address::factory()->create([
            'user_id'=>$user->id 
        ]);

         $this->jsonAs($user , 'GET' , '/api/address')->assertJsonFragment([
                 'building'=>$address->building
         ]); 

         $this->assertEquals(3 , $user->addresses()->count());

    }








    


}
