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

        $this->get(route('country.show', ['countryId' => $country->id]))
            ->assertStatus(200);
    }

    /**
     * Route: country.delete
     *
     * @test
     * @group all
     */
    public function testDeleteControllerValid()
    {
        $country = factory(Country::class)->create();

        $this->get(route('country.delete', ['countryId' => $country->id]))
            ->assertStatus(302)
            ->assertSessionHas([
                'class'   => 'alert alert-success',
                'message' => trans('country.flash-delete')
            ]);

        $this->assertDatabaseMissing('countries', ['id' => $country->id]);
    }

    /**
     * ROUTE: country.delete
     *
     * @test
     * @group all
     */
    public function testDeleteControllerInvalid()
    {
        $country = factory(Country::class)->create();

        $this->get(route('country.delete', ['countryId' => 145]))
            ->assertStatus(302)
            ->assertSessionMissing([
                'class'   => 'alert alert-success',
                'message' => trans('country.flash-delete')
            ]);

        $this->assertDatabaseHas('countries', ['id' => $country->id]);
    }
}
