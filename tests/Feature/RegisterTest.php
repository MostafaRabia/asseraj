<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class RegisterTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     */
    public function testRegister()
    {
        Event::fake();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->postJson('/api/register', [
            'name' => $this->faker->firstName,
            'email' => 'mostafarabia64@gmail.com',
            'password' => '12345678',
        ]);

        $response->dump();

        $response->assertStatus(200);

        Event::assertDispatched(Registered::class);
    }
}
