<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class SupportControllerTest
 *
 * @package Tests\Feature
 */
class SupportControllerTest extends TestCase
{
    /**
     * ROUTE: support.index
     *
     * This controller test if the support index page can be
     * Rendered without errors.
     *
     * @test
     * @group all
     * @group support
     */
    public function testIndexController()
    {
        $this->get(route('support.index'))->assertStatus(200);
    }

    /**
     * ROUTE: support.search
     *
     * This controller test if the user can search
     * for a specific thread.
     *
     * @test
     * @group all
     * @group support
     */
    public function testSearchController()
    {
        $input = ['term' => 'test'];
        $this->get(route('support.search'), $input)->assertStatus(200);
    }

    /**
     * ROUTE: support.create
     *
     * This function test if the user can see
     * the create view for a new support question.
     */
    public function testStoreController()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->seeIsAuthenticatedAs($user)
            ->get(route('support.create'))
            ->assertStatus(200);
    }
}
