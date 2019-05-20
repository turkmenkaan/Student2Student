<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    /** @test */
    public function a_doctor_can_register() {
        $response = $this->json('POST', '/register', []);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
