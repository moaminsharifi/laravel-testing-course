<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fetches_trending_articles()
    {
        // Given
        Article::factory()->count(3)->create();
        // article with high reads
        Article::factory()->create(['reads'=>10]);
        $mostPopular = Article::factory()->create(['reads'=>30]);
        Article::factory()->create(['reads'=>20]);
        // When
       $articles = Article::trending() ;

        // Then
        $this->assertEquals($mostPopular->id , $articles->first()->id);
        $this->assertCount(3 , $articles);

    }
}
