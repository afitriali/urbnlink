<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = ['name', 'description'];

	public function addMember(User $user)
	{
		$this->ProjectMembers()->create([
			'user_id' => $user->id
		]);

		return $this;
	}

	public function removeMember(User $user) {
		if ($this->admin() != $user) {
			return $this->ProjectMembers()->delete($user);
		}

		return $this;
	}

	public function createInvitation($email)
	{
		$this->ProjectInvitations()->create([
			'email' => $email
		]);

		return $this;
	}

	public function deleteInvitation(ProjectInvitation $invitation)
	{
		$this->ProjectInvitations()->delete($invitation);

		return $this;
	}

	public function changeAdmin(User $user) {
		$this->admin()->associate($user);
		$this->save();

		return $this;
	}

	public function admin()
	{
		return $this->belongsTo(User::class);
	}
	
	public function defaultLink()
	{
		return $this->belongsTo(Link::class);
	}

	public function links()
	{
		return $this->hasMany(Link::class);
	}

	public function projectMembers()
	{
		return $this->hasMany(ProjectMember::class);
	}

	public function projectInvitations()
	{
		return $this->hasMany(ProjectInvitation::class);
	}

	public function domains()
	{
		return $this->hasMany(Domain::class);
	}

	public function pages()
	{
		return $this->hasMany(Page::class);
	}
}
