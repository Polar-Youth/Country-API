<?php

namespace Tests\Feature;

use App\Country;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BorderControllerTest extends TestCase
{
    /**
     * ROUTE: border.create
     *
     * @test
     * @group all
     * @group border
     */
    public function testCreateBorderNoCountry()
    {
        $route = route('border.create', ['borderId' => 123]);

        $this->post($route)
            ->assertStatus(302)
            ->assertSessionMissing([
                'class' => 'alert alert-success',
                'message' => trans('country.flash-border-create')
            ]);
    }

    /**
     * ROUTE: border.create
     *
     * @test
     * @group all
     * @group border
     */
    public function testCreateBorderValidationErrors()
    {
        $country = factory(Country::class)->create();
        $route   = route('border.create', ['borderId' => $country->id]);

        $this->post($route, [])
            ->assertStatus(302)
            ->assertSessionMissing([
                'class' => 'alert alert-success',
                'message' => trans('country.flash-border-create')
            ]);
    }
}
