<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
	protected $fillable = [
		'country',
		'agent',
		'referrer',
		'page',
		'created_at'
	];

	public function link()
	{
		return $this->belongsTo(Link::class);
	}
}

