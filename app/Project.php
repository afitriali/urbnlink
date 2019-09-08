<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = ['name', 'description'];

	public function inviteMember(User $user) {
		$this->ProjectMembers()->create([
			'user_id' => $user->id
		]);

		return $this;
	}

	public function leaveProject(User $user) {
		if ($this->admin() != $user) {
			return $this->ProjectMembers()->delete($user);
		}

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

	public function domains()
	{
		return $this->hasMany(Domain::class);
	}

	public function pages()
	{
		return $this->hasMany(Page::class);
	}
}
