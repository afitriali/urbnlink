<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
	protected $fillable = [
		'country',
		'agent',
		'referrer',
		'url'
	];

	public function link()
	{
		return $this->belongsTo(Link::class);
	}
}

