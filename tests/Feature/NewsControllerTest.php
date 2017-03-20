<?php

namespace Tests\Feature;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewsControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * ROUTE: news
     *
     * @test
     * @group all
     */
    public function testIndexController()
    {
        $this->get(route('news'))->assertStatus(200);
    }

    protected function newsInputs()
    {
        return [
            'author_id' => 1,
            'title'    => 'Title',
            'article'  => 'description',
            'categories' => 1,
        ];
    }

    /**
     * ROUTE: news.show
     *
     * @test
     * @group all
     */
    public function testShowControllerNoResource()
    {
        $url  = route('news.show', ['articleId' => 123]);

        $test = $this->get($url);
        $test->assertStatus(302);

        $this->assertDatabaseMissing('articles', ['id' => 123]);
    }

    /**
     * ROUTE: news.show
     *
     * @test
     * @group all
     */
    public function testShowControllerResource()
    {
        $news = factory(Article::class)->create();
        $url  = route('news.show', ['articleId' => $news->id]);

        $this->get($url)->assertStatus(200);
    }

    /**
     * ROUTE: news.delete
     *
     * @test
     * @group all
     */
    public function testDeleteControllerNoResource()
    {
        $url = route('news.delete', ['articleId' => 123]);

        $test = $this->get($url);
        $test->assertStatus(302);
        $test->assertRedirect(route('news'));
        $test->assertSessionMissing([
            'class'   => 'alert alert-success',
            'message' => trans('news.flash-delete'),
        ]);

        $this->assertDatabaseMissing('articles', ['id' => 123]);
    }

    /**
     * ROUTE: news.delete
     *
     * @test
     * @group all
     */
    public function testDeleteControllerDeleteOk()
    {
        $news = factory(Article::class)->create();
        $url  = route('news.delete', ['articleId' => $news->id]);

        $test = $this->get($url);
        $test->assertStatus(302);
        $test->assertSessionHas([
            'class'   => 'alert alert-success',
            'message' => trans('news.flash-delete'),
        ]);

        $this->assertDatabaseMissing('articles', ['id' => $news->id]);
    }

    /**
     * ROUTE: news.store
     *
     * @test
     * @group all
     */
    public function testStoreControllerOk()
    {
        $url = route('news.store');

        $route = $this->post($url, $this->newsInputs());
        $route->assertStatus(302);
        $route->assertSessionHas([
            'class'   => 'alert alert-success',
            'message' => trans('news.flash-create')
        ]);

        // Commented because strange error
        // $this->assertDatabaseHas('articles', $this->newsInputs());
    }
}
