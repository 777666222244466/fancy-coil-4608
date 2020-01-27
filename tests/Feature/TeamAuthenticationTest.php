<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamAuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_register()
    {
        $this->get('/team/register')->assertStatus(200);

        // $this->post('/team/register', [
        //     'name' => $this->faker->company,
        //     'email' => $this->faker->unique()->companyEmail,
        //     'password' => $this->faker->unique()->password,
        // ])
        // ->assertRedirect('/team/register')
        // ->assertSessionHas([
        //     'status' => 'Please check your email for verification.',
        // ]);

        // assert database?
    }

    /** @test */
    public function registration_requires_email_verification()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function it_can_login()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function it_can_logout()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function it_can_reset_password()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function name_is_required()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function email_is_required()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function email_must_be_an_email()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function password_is_required()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function password_must_be_at_least_6_characters()
    {
        $this->markTestSkipped();
    }
}
