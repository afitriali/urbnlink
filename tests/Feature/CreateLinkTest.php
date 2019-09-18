<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLinkTest // extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testCreateValidLink()
    {
        // Valid URL
        $response = $this->json('POST', env('API_URL', 'https://api.urbn.link').'/link/create', [
            'url' => 'https://fitriali.com',
        ]);
        $response->assertJson(['created' => true]);

        // Valid URL and Name
        $response = $this->json('POST', env('API_URL', 'https://api.urbn.link').'/link/create', [
            'url' => 'https://github.com',
            'name' => 'git'
        ]);
        $response->assertJson(['created' => true]);
    }

    public function testCreateInvalidLink()
    {
        // Name Invalid: Duplicate Name
        $link = new \App\Link\Link;
        $link->create([
            'url' => 'https://fitri.co',
            'name' => 'fitri'
        ]);
        $response = $this->json('POST', env('API_URL', 'https://api.urbn.link').'/link/create', [
            'url' => 'https://fitri.co',
            'name' => 'fitri'
        ]);
        $response->assertJson(['created' => false]);

        // Name Invalid: Name Too Short
        $response = $this->json('POST', env('API_URL', 'https://api.urbn.link').'/link/create', [
            'url' => 'https://fitri.co',
            'name' => 'g'
        ]);
        $response->assertJson(['created' => false]);

        // Name Invalid: Name Not Alphanumeric
        $response = $this->json('POST', env('API_URL', 'https://api.urbn.link').'/link/create', [
            'url' => 'https://fitri.co',
            'name' => '!!!'
        ]);
        $response->assertJson(['created' => false]);

        // URL Invalid: No HTTP/HTTPS
        $response = $this->json('POST', env('API_URL', 'https://api.urbn.link').'/link/create', [
            'url' => 'fitri.co',
        ]);
        $response->assertJson(['created' => false]);

        // URL Invalid: Website Doesn't Exist
        $response = $this->json('POST', env('API_URL', 'https://api.urbn.link').'/link/create', [
            'url' => 'https://fitri',
        ]);
        $response->assertJson(['created' => false]);
    }
}
