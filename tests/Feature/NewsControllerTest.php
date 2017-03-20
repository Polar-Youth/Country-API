<?php

namespace Tests\Feature;

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
}
