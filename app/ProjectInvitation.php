<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectInvitation extends Model
{
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
