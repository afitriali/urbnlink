<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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
