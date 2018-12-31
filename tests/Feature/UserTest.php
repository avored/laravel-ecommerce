<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
     public function home_route_status_check()
     {
        $response = $this->get('/');
        $response->assertSee('AvoRed E commerce');
        //dd($response->content());
     }
}
