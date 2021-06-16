<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLogin()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->postJson('/api/login', [
            'email' => 'mostafarabia64@gmail.com',
            'password' => '12345678',
        ]);

        $response->dump();

        $response->assertStatus(200);
    }
}
