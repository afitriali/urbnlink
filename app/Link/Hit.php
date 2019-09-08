<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
	protected $fillable = [
		'country',
		'agent',
		'referrer',
		'page'
	];

	public function link()
	{
		return $this->belongsTo(Link::class);
	}
}

