<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProject()
    {
	$user = factory(\App\User::class)->create();
	$project = factory(\App\Project::class)->make();

        $response = $this->actingAs($user)->json('POST', env('DASHBOARD_URL', 'https://dashboard.urbn.link').'/project', [
            'name' => $project->name,
            'description' => $project->description
        ]);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name,
            'description' => $project->description
        ]);
    }
}
