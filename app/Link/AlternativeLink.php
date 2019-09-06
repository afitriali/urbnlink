<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;

class AlternativeLink extends Model
{
	protected $fillable = ['url', 'link_type_id', 'priority', 'description'];

	public function link()
	{
		return $this->belongsTo(Link::class);
	}
	
	public function linkType()
	{
		return $this->belongsTo(LinkType::class);
	}

	public function conditions()
	{
		return $this->hasMany(Condition::class);
	}
}
