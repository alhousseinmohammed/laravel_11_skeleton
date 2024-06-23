<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Support\Facades\DB;

class RegisterUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setup(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
        $this->seed(AdminUserSeeder::class);
    }

    #[Test]
    public function itRegisterUser(): void
    {
        $response = $this->postJson(
            route(
                'auth.register', [
                    'name' => 'Hashim',
                    'email' => 'hashim@gmail.com',
                    'password' => '@-password-19',
                    'password_confirmation' => '@-password-19',
                ]
            )
        );

        $response->assertSuccessful();

        $message = $response->json('message');
        $this->assertEquals($message, "register_successfully");
    }

    #[Test]
    public function itValidateRegisterUser(): void
    {
        $response = $this->postJson(
            route(
                'auth.register', [
                    'name' => '22',
                    'email' => 'not_email_string',
                    'password' => '@-password-19',
                    'password_confirmation' => '@-password-19',
                ]
            )
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('email', $response->json('errors'));
    }
}
