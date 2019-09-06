<?php

namespace App\Page;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
	public function pages()
	{
		return $this->hasMany(Page::class);
	}
}
