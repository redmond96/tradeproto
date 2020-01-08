<?php

namespace Tests\Feature;
use App\UserProfile;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileRatingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_cannot_be_rated_by_guests()
    {
        $userprofiles = factory(Article::class)->create();
        $this->post("/userprofiles/{$userprofiles->id}/rate")->assertRedirect('login');
        $this->assertEmpty($userprofiles->ratings);
    }

    /** @test */
    function it_can_be_rated_by_authenticated_users()
    {
        $this->actingAs(
            $user = factory(User::class)->create()
        );
        $userprofiles = factory(Article::class)->create();
        $this->post("/userprofiles/{$userprofiles->id}/rate", ['rating' => 5]);
        $this->assertEquals(5, $userprofiles->rating());
    }

    /** @test */
    function it_can_update_a_users_rating()
    {
        $this->actingAs(
            $user = factory(User::class)->create()
        );
        $userprofiles = factory(Article::class)->create();
        $this->post("/userprofiles/{$userprofiles->id}/rate", ['rating' => 5]);
        $this->assertEquals(5, $userprofiles->rating());
        $this->post("/userprofiles/{$userprofiles->id}/rate", ['rating' => 1]);
        $this->assertEquals(1, $userprofiles->rating());
    }

    /** @test */
    function it_requires_a_valid_rating()
    {
        $this->actingAs(
            $user = factory(User::class)->create()
        );
        $userprofiles = factory(Article::class)->create();
        $this->post("/userprofiles/{$userprofiles->id}/rate")->assertSessionHasErrors('rating');
        $this->post("/userprofiles/{$userprofiles->id}/rate", ['rating' => 'foo'])->assertSessionHasErrors('rating');
    }
}
