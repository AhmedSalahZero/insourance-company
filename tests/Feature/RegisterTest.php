<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User ;
use App\Models\Address ;
class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_requires_name()
    {
        $response = $this->json('post','/api/auth/register' )->assertJsonValidationErrors([
            'name'
        ]);
    }
    public function test_it_requires_email()
    {
        $response = $this->json('post','/api/auth/register' )->assertJsonValidationErrors([
            'email'
        ]);
    }
    public function test_it_requires_unique_email()
    {
        $user = User::factory()->create([
            'email'=>'email@yahoo.com'
        ]);

        $response = $this->json('post','/api/auth/register' ,[
            'email'=>$user->email
        ])->assertJsonValidationErrors([
            'email'
        ]);
    }
    public function test_it_requires_valid_email()
    {
        $response = $this->json('post','/api/auth/register'  , [
            'email'=>'ahmedEmail'
        ])->assertJsonValidationErrors([
            'email'
        ]);
    }

    public function test_it_requires_phone()
    {
        $response = $this->json('post','/api/auth/register' )->assertJsonValidationErrors([
            'phone'
        ]);
    }

    public function test_it_requires_password()
    {
        $response = $this->json('post','/api/auth/register' )->assertJsonValidationErrors([
            'password'
        ]);
    }

    public function test_it_register_user()
    {
        $user = User::factory()->make([
            'name'=>$name = 'ahmed',
            'phone'=>$email = '01025894984',
            'password'=>123456
        ]);


        $response = $this->json('post','/api/auth/register',array_merge($user->toArray(),['password'=>123456])  )->assertJsonFragment([
            'name'=>$name = 'ahmed',
            'phone'=>$email = '01025894984' ,
        ]);

        $this->assertDataBaseHas('users',[
            'name'=>$name,
            'phone'=>$email
        ]);
    }

}
