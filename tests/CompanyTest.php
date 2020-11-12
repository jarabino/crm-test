<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{
    // use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function testGetCompanies()
    {
        //Given we have article in the database
        // $company = factory('App\Company')->create();
 
        //When user visit the articles page
        $response = $this->get('/company'); // your route to get article
 
        //He should be able to read the articles
        // $response->assertSee($company->name);
    }
}
