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
     * The inputs for testing the update and create.
     *
     * @return array
     */
    protected function countryInput()
    {
        return [
            'continent_id'  => 4,
            'code'          => 'BE',
            'name'          => 'Belguim',
            'flag'          => 'Image.jpg',
            'fips_code'     => '053',
            'iso_code'      => 'BEL',
            'north_num'     => '1256',
            'south_num'     => '1234',
            'east_num'      => '1234',
            'west_num'      => '1234',
            'capital'       => 'Brussels',
            'iso_alpha_2'   => 'BE',
            'iso_alpha_3'   => 'BEL',
            'geoname_id'    => '2467'
        ];
    }

    /**
     * Database check fields and data.
     *
     * @param  array $record The factory data
     * @return array
     */
    protected function dbCheck($record)
    {
        return [
            'continent_id'  => $record->continent_id,
            'code'          => $record->code,
            'name'          => $record->name,
            'flag'          => $record->flag,
            'fips_code'     => $record->fips_code,
            'iso_code'      => $record->iso_code,
            'north_num'     => $record->north_num,
            'south_num'     => $record->south_num,
            'east_num'      => $record->east_num,
            'west_num'      => $record->west_num,
            'capital'       => $record->capital,
            'iso_alpha_2'   => $record->iso_alpha_2,
            'iso_alpha_3'   => $record->iso_alpha_3,
            'geoname_id'    => $record->geoname_id
        ];
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

    /**
     * ROUTE: country.update
     *
     * @test
     * @group all
     */
    public function testResourceNotExistUpdate()
    {
        $country = factory(Country::class)->create();

        $route = $this->post(route('country.update', ['countryId' => 123]));
        $route->assertStatus(302);
        $route->assertSessionMissing([
            'class'   => 'alert alert-success',
            'message' => trans('country.flash-update', ['country' => $country->name]),
        ]);
    }

    /**
     * ROUTE: country.update
     *
     * @test
     * @group all
     */
    public function testResourceExistValidationError()
    {
        $country = factory(Country::class)->create();
        $url     = route('country.update', ['countryId' => $country->id]);

        $route = $this->post($url, []);
        $route->assertStatus(302);
        $route->assertSessionHasErrors();
        $route->assertSessionMissing([
            'class'   => 'alert alert-success',
            'message' => trans('country.flash-update', ['country' => $country->name]),
        ]);
    }

    public function testResourceUpdateSuccess()
    {
        $country = factory(Country::class)->create();
        $route   = route('country.update', ['countryId' => $country->id]);

        $test = $this->post($route, $this->countryInput());
        $test->assertStatus(302);
        $test->assertSessionHas([
            'class'   => 'alert alert-success',
            'message' => trans('country.flash-update'),
        ]);

        $this->assertDatabaseHas('countries', $this->countryInput());
        $this->assertDatabaseMissing('countries', $this->dbCheck($country));
    }
}
