<?php

namespace App\Page;
use App\Project;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	public function template()
	{
		return $this->belongsTo(Template::class);
	}

	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
