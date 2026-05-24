<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected array $user = [
            'name' => 'John Doe',
            'email' => 'JonhDoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
    ];
    public function test_register_user(): void
    {

        $response = $this->post('v1/auth/register', $this->user);

        $response->assertRedirect('login');

    }

    public function test_user_registered(): void
    {
        // primeiro registro
        $this->postJson('v1/auth/register', $this->user);

        // tenta registrar novamente
        $response = $this->postJson('v1/auth/register', $this->user);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors([
            'email'
        ]);
    }

    public function test_password_mismatch(): void
    {
        $user = [
            'name' => 'John Doe',
            'email' => 'JonhDoe@example.com',
        ];
       $response = $this->postJson('v1/auth/register', $user);

       $response->assertStatus(422);

       $response->assertJsonValidationErrors([
            'password'
        ]);
    }

    public function test_email_mismath(): void
    {
        $user = [
            'name' => 'John Doe',
            'password' => 'password',
        ];

        $response = $this->postJson('v1/auth/register', $user);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['email']);
    }

    public function test_login_user(): void
    {

        $user = [
            'name' =>  Factory::create()->name,
            'email' => Factory::create()->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $this->postJson('v1/auth/register',$user);

        $response = $this->postJson('v1/auth/login', $user);

        $response->assertRedirect('/dashboard');
    }
}
