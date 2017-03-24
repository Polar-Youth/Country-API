<?php

namespace Tests\Feature;

use App\Categories;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class CategoryControllerTest
 *
 * @package Tests\Feature
 */
class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Route::categories
     *
     * @test
     * @group all
     */
    public function testIndexController()
    {
        $this->get(route('categories'))->assertStatus(200);
    }

    /**
     * Route: category.show
     *
     * @test
     * @group all
     */
    public function testShowWithData()
    {
        $category = factory(Categories::class)->create();

        $this->get(route('category.show', ['tagId' => $category->id]))
            ->assertStatus(200);
    }

    /**
     * Route: category.show
     *
     * @test
     * @group all
     */
    public function testShowNoData()
    {
       $this->get(route('category.show', ['tagId' => 123]))
           ->assertStatus(302)
           ->assertRedirect(route('categories'));
    }

    /**
     * Route: category.delete
     *
     * @test
     * @group all
     */
    public function testDestroyWithData()
    {
        $category = factory(Categories::class)->create();
        $route    = route('category.delete', ['categoryId' => $category->id]);

        $test = $this->get($route);
        $test->assertStatus(302);
        $test->assertSessionHas([
            'class' => 'alert alert-success',
            'message' => trans('categories.flash-delete', ['category' => $category->name])
        ]);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Route: category.create
     *
     * @test
     * @group all
     */
    public function testCategoryCreateView()
    {
        $route = $this->get(route('category.create'));
        $route->assertStatus(200);
    }

    /**
     * Route: category.store
     *
     * @test
     * @group all
     */
    public function testCategoryInsertError()
    {
        $route = route('category.store');

        $this->post($route, [])
            ->assertStatus(302)
            ->assertSessionMissing([
                'class' => 'alert alert-success',
                'message' => trans('categories.flash-store')
            ]);
    }

    /**
     * Route: category.store
     *
     * @test
     * @group all
     */
    public function testCategoryInsertOk()
    {
        $route = route('category.store');

        $input['module']        = 'Support';
        $input['name']          = 'Category name';
        $input['description']   = 'category description';

        $this->post($route, $input)
            ->assertStatus(302)
            ->assertSessionHas([
                'class' => 'alert alert-success',
                'message' => trans('categories.flash-store')
            ]);

        $this->assertDatabaseHas('categories', $input);
    }

    /**
     * Route: category.edit
     *
     * @test
     * @group all
     */
    public function testCategoryTestEditNoData()
    {
        $route = route('category.edit', ['categoryId' => 123]);

        $this->get($route)->assertStatus(302);
    }

    /**
     * Route: category.delete
     *
     * @test
     * @group all
     */
    public function testDestroyWithNoData()
    {
        $category = factory(Categories::class)->create();
        $route    = route('category.delete', ['categoryId', 123]);

        $this->get($route)
            ->assertStatus(302)
            ->assertSessionMissing([
                'class' => 'alert alert-success',
                'message' => trans('categories.flash-delete', ['category' => $category->name])
            ]);
    }
}
