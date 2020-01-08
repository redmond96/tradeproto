<?php

namespace Tests\Feature;

use App\UserProfile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;
class ArticleTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp()
    {
        parent::setUp();
        $this->userprofile = factory(UserProfile::class)->create();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    function it_can_be_rated()
    {
        $this->userprofile->rate(5, $this->user);
        $this->assertCount(1, $this->article->ratings);
    }

    /** @test */
    function it_can_calculate_the_average_rating()
    {
        $this->userprofile->rate(5, $this->user);
        $this->userprofile->rate(1, factory(User::class)->create());
        $this->assertEquals(3, $this->userprofile->rating());
    }

    /** @test */
    function it_cannot_be_rated_above_5()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->userprofile->rate(6);
    }

    /** @test */
    function it_cannot_be_rated_below_1()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->userprofile->rate(-1);
    }

    /** @test */
    function it_can_only_be_rated_once_per_user()
    {
        $this->actingAs($this->user);
        $this->userprofile->rate(5);
        $this->userprofile->rate(1);
        $this->assertEquals(1, $this->userprofile->rating());
    }
}
