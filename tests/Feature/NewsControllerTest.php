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
}
