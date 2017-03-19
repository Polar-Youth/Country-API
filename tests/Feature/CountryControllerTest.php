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
    use DatabaseMigrations, DatabaseTransactions;

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
    public function testShowControllerValid()
    {
        $country = factory(Country::class)->create();

        $this->get(route('country.show', ['countryId' => $country->id]))
            ->assertStatus(200);
    }


    /**
     * Route: country.show
     *
     * @test
     * @group all
     */
    public function testShowControllerInvalid()
    {
        $this->get(route('country.show', ['countyId' => 452]))
            ->assertStatus(302)
            ->assertRedirect(route('country'));
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

        $route = $this->get(route('country.delete', ['countryId' => $country->id]));
        $route->assertStatus(302);
        $route->assertSessionHas([
                'class'   => 'alert alert-success',
                'message' => trans('country.flash-delete', ['country' => $country->name])
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

        $route = $this->get(route('country.delete', ['countryId' => 145]));
        $route->assertStatus(302);
        $route->assertSessionMissing([
                'class'   => 'alert alert-success',
                'message' => trans('country.flash-delete', ['country' => $country->id])
            ]);

        $this->assertDatabaseHas('countries', ['id' => $country->id]);
    }
}
