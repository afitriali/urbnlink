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
        $link->generate('https://fitri.co', env('DEFAULT_DOMAIN', 'ur.bn'), 10, 'fit');

        $link = \App\Link\Link::hasName('fit')->first();
        $link->toggleConditional();

        $condition_set = $link->conditionSets()->create([
            'name' => 'Limit Visitors',
            'priority' => 0
        ]);

        $alternative = $condition_set->alternativeLink()->create([
            'url' => 'https://dev.to/fitri'
        ]);

        $condition_set->conditions()->create([
            'condition_type_id' => 110,
            'amount' => 2
        ]);

        $response = $this->get(env('APP_URL').'/'.$link->name);
        $response->assertRedirect($alternative->url);
        $response = $this->get(env('APP_URL').'/'.$link->name);
        $response->assertRedirect($alternative->url);
        $response = $this->get(env('APP_URL').'/'.$link->name);
        $response->assertRedirect($link->url);

        $link->toggleActive();

        $response = $this->get(env('APP_URL').'/'.$link->name);
        $response->assertStatus(404);
    }
}
