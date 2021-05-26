<?php

namespace Tests\Unit;



use Tests\TestCase;
use App\Models\User ;
use App\Models\Address ; 
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_encrypt_the_password_when_user_is_created()
    {
        $user = User::factory()->create([
            'password'=>'salah'
        ]);
        $this->assertNotEquals($user->password , 'salah');
    }
    public function test_it_has_many_address()
    {
        $user = User::factory()->create();

        $user->addresses()->save(
            Address::factory()->create([
                'user_id'=>$user->id
            ])
        );
        $user->addresses()->save(
            Address::factory()->create([
                'user_id'=>$user->id
            ])
        );
   
        $this->assertInstanceOf(Address::class , $user->addresses->first());
    }

}
