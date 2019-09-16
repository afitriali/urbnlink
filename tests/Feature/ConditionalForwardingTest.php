<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConditionalForwardingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testLoadConditionalLink()
    {
        $link = new \App\Link\Link;
		$link->create([
			'name' => 'fit',
			'domain' => env('DEFAULT_SHORT_DOMAIN', 'ur.bn'),
			'url' => 'https://fitriali.com',
			'link_type' => 10,
		]);

        $link = \App\Link\Link::hasName('fit')->first();
        $link->toggleConditional();

        $alternative_link = $link->alternativeLinks()->create([
			'url' => 'https://dev.to/fitri',
			'link_type' => 10,
            'name' => 'Limit Visitors',
            'priority' => 0
        ]);

        $alternative_link->conditions()->create([
            'condition_type_id' => 110,
            'values' => ['amount' => 2]
        ]);

        $response = $this->get('https://'.$link->domain.'/'.$link->name);
        $response->assertLocation($alternative_link->url);
        $response = $this->get('https://'.$link->domain.'/'.$link->name);
        $response->assertLocation($alternative_link->url);
        $response = $this->get('https://'.$link->domain.'/'.$link->name);
        $response->assertLocation($link->url);

        $link->toggleActive();

        $response = $this->get('https://'.$link->domain.'/'.$link->name);
        $response->assertStatus(404);
    }
}
