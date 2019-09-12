<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Domain extends Model
{
	protected $fillable = ['name', 'verified_at'];

	public function scopeHasName($query, $name)
	{
		return $query->where('name', $name);
	}

	public function scopeIsVerified($query)
	{
		return $query->whereNotNull('verified_at');
	}
	
	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	public function defaultLink()
	{
		return $this->belongsTo(Link\Link::class);
	}
}
