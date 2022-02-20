<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BrowserTestCase;

class HomePageTest extends BrowserTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        // Visit Home page
        $this->visit(route('home'))
        // Check see Click Me
        ->see('Click Me')
        // Click On Click Me
        ->click('Click Me')
        // Check see Clicked
        ->see('Feedback page')
        // Assert that the current URL is '/feedback'
        ->seePageIs(route('feedback'));
    }
}
