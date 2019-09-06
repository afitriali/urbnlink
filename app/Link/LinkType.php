<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;

class LinkType extends Model
{
	public function links()
	{
		return $this->hasMany(Link::class);
	}

	public function alternativeLinks()
	{
		return $this->hasMany(AlternativeLink::class);
	}
}
