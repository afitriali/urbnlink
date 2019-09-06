<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForwardingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testLoadRegularLink()
    {
        $link = new \App\Link\Link;
        $link->generate('https://github.com', env('DEFAULT_DOMAIN', 'ur.bn'), 10, 'git');
        $this->assertDatabaseHas('links', ['name' => 'git']);
    }
}
