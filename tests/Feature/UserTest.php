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

    /**
     * A basic login post.
     *
     * @return void
     */
    public function testFrontLoginPost()
    {
        $user = $this->getFrontUser();
        $response = $this->post('/login', ['email' => $user->email, 'password' => $this->userPassword]);

        //$this->assertDatabaseHas('admin_users',['email' => $this->adminUser->email]);
        $response->assertRedirect('/my-account');
    }


    /**
     * A basic login post.
     *
     * @return void
     */
    public function testFrontRegisterPost()
    {

        $email = $this->faker->email;
        $response = $this->post('/register', ['first_name' =>'Test Name','last_name' => 'Test Last',
                                                    'email' => $email,
                                                    'password' => 'admin123' ,
                                                    'password_confirmation' => 'admin123']);

        $this->assertDatabaseHas('users',['email' => $email]);
        $response->assertRedirect('/my-account');
    }}
