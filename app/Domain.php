<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Domain extends Model
{
	public function scopeHasName($query, $name)
	{
		return $query->where('name', $name);
	}
	
	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	public function defaultLink()
	{
		return $this->belongsTo(Link::class);
	}
}
