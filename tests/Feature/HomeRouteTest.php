<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class HomeRouteTest
 *
 * @package Tests\Feature
 */
class HomeRouteTest extends TestCase
{
    // DatabaseMigrations   = Used to migrate the database.
    // DatabaseTransactions = Used to run queries against the database.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * ROUTE: home.frontend
     *
     * @test
     * @group all
     */
    public function testIndexRoute()
    {
        $this->get(url('/'))->assertStatus(200);
    }

    /**
     * ROUTE: home.backend
     *
     * @test
     * @group all
     */
    public function testBackendRoute()
    {
        $user = factory(User::class)->create();

        $auth = $this->actingAs($user);
        $auth->seeIsAuthenticatedAs($user);

        $this->get(url('/home'))->assertStatus(200);
    }
}
