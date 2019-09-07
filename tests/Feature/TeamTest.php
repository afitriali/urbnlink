<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest // extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testCreateTeam()
    {
        $team = \App\Team::create([
            'name' => 'Team One',
            'description' => 'Team One'
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Team One',
            'description' => 'Team One'
        ]);
    }

    public function testJoinTeam()
    {
        $team = \App\Team::create([
            'name' => 'Team One',
            'description' => 'Team One'
        ]);

		$user = \App\User::create([
			'name' => 'User One',
			'email' => 'user.one@email.com',
			'password' => bcrypt('password')
		]);
		$this->assertDatabaseHas('users', ['name' => 'User One']);

		$team_member_role = \App\TeamMemberRole::find(10);

		$team->inviteMember($user, $team_member_role);
		$this->assertDatabaseHas('team_members', [
			'team_id' => $team->id,
			'user_id' => $user->id,
			'team_member_role_id' => 10
		]);
    }

    public function testLeaveTeam()
    {
        $team = \App\Team::create([
            'name' => 'Team One',
            'description' => 'Team One'
        ]);

		$user = \App\User::create([
			'name' => 'User One',
			'email' => 'user.one@email.com',
			'password' => bcrypt('password')
		]);

		$team_member_role = \App\TeamMemberRole::find(10);
		$team->inviteMember($user, $team_member_role);
		$team->leaveTeam($user);

		$this->assertDatabaseMissing('team_members', [
			'user_id' => $user->id,
		]);
    }

    public function testChangeRole()
    {
        $team = \App\Team::create([
            'name' => 'Team One',
            'description' => 'Team One'
        ]);

		$user = \App\User::create([
			'name' => 'User One',
			'email' => 'user.one@email.com',
			'password' => bcrypt('password')
		]);

		$team_member_role = \App\TeamMemberRole::find(10);
		$team->inviteMember($user, $team_member_role);

		$new_team_member_role = \App\TeamMemberRole::find(11);
		$team->changeRole($user, $new_team_member_role);

		$this->assertDatabaseHas('team_members', [
			'user_id' => $user->id,
			'team_member_role_id' => 11,
		]);
    }
}
