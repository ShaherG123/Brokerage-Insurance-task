<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function setUp() :void{
        
        parent::setUp();
        $this->token = csrf_token();
        $response = $this->call('POST', '/post-login', [
            'email' => 'mahmoud@sm.developer.com',
            'password' => 'mahmoud123456',
            //'_token' => $this->token,
        ]);
      }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getCategoriesSuccessful()
    {
        $response = $this->call('GET', '/api/categories',[
            'token' => $this->token,
        ]);

        //dd($response);
        $response->assertStatus(200);
    }
}
