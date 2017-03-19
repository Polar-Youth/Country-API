<?php

namespace Tests\Feature;

use App\Country;
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

    /**
     * Route: country.show
     *
     * @test
     * @group all
     */
    public function testShowController()
    {
        $country = factory(Country::class)->create();

        $this->get(route('country.show', ['countryId' => $country->show]))
            ->assertStatus(200);
    }
}
