<?php

namespace Tests\Feature;

use App\Models\Workout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_an_auth_user_can_see_trainings_index_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/workouts')->assertStatus(200);
    }

    public function test_an_auth_user_can_create_workout()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get('/workouts/create')->assertStatus(200);

        $attributes = [
            'user_id' => auth()->id(),
            'name' => $this->faker->sentence(3),
            'body' => $this->faker->paragraph(2),
            'level' => $this->faker->word(),
            'image_url' => $this->faker->image()
        ];

        $response = $this->post('/workouts', $attributes);
        $workout = Workout::where($attributes)->first();
        $response->assertRedirect('/workouts');
    }
}
