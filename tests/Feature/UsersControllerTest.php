<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class UsersControllerTest
 *
 * @package Tests\Feature
 */
class UsersControllerTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * ROUTE: users
     *
     * @group all
     * @group users
     */
    public function testIndexController()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->seeIsAuthenticatedAs($user)
            ->get(route('users'))
            ->assertStatus(200);
    }
}
