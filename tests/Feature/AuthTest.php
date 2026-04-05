<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function createUser(): array
    {
        $password = 'Pass123';
        $user = User::factory()->create([
            'email' => 'teste@email.com.br',
            'password' => bcrypt($password) 
        ]);

        return [$user, $password];
    }

    public static function InvalidLoginProvider(): array
    {
        return [
            'incorrect_password' => ["exists@email.com", "password", 403],
            'incorrect_email' => ['not_exists@email.com', "pass103", 403],
            'empty_email' => ["", "pass103", 422],
            'empty_password' => ["email@email", "", 422]
        ];
    }
   
    public function test_the_user_can_log_in_with_the_correct_credentials(): void
    {
        [$user, $password] = $this->createUser();

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200)->assertJsonStructure(['message', 'token']);
        $this->assertAuthenticatedAs($user);
    }
        
    public function test_the_user_cannot_log_in_with_invalid_credentials(): void
    {
        [$user, $password] = $this->createUser();

        $response1 = $this->postJson('/api/v1/login', [
            'email' => 'teste@email.com',
            'password' => '123'
        ]);

        $response2 = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => '123'
        ]);

        $response3 = $this->postJson('/api/v1/login', [
            'email' => 'teste@email.com',
            'password' => $password
        ]);

        $response1->assertStatus(403)->assertJsonStructure(['message']);
        $response2->assertStatus(403)->assertJsonStructure(['message']);
        $response3->assertStatus(403)->assertJsonStructure(['message']);
    }

    #[DataProvider('InvalidLoginProvider')]
    public function test_login_validation_rules($email, $password, $code): void
    {
        User::factory()->create(["email" => "existis@email.com", "password" => bcrypt('pass103')]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus($code);
    }

    public function test_use_logged_in_can_log_out(): void
    {
        [$user] = $this->createUser();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(["Authorization" => "Bearer $token"])
                        ->postJson('/api/v1/logout');

        $response->assertStatus(200)
                ->assertJson([
                    'message' => "Logged out successfull"
                ]);
    }

}
