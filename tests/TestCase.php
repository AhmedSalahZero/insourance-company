<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase ;

    use CreatesApplication;

    protected function jsonAs($user , $method , $endpoint , $data=[] , $header =[] ){

        $token = Auth()->tokenById($user->id);
        
        return $this->json( $method , $endpoint , $data , array_merge($header , [
            'Authorization'=>'bearer '.$token 
        ]));
    }
}
