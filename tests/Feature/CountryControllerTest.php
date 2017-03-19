<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class CountryControllerTest
 *
 * @package Tests\Feature
 */
class CountryControllerTest extends TestCase
{
    /**
     * Route: country
     *
     * @test
     * @group all
     */
    public function testIndexController()
    {
        $this->get(route('country'))->assertStatus(200);
    }
}
