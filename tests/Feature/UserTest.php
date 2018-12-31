<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic login example.
     *
     * @return void
     */
    public function testFrontLoginGet()
    {
        $response = $this->get('/login');
        $response->assertSee('AvoRed Login');
    }
}
