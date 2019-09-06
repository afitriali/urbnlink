<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Helpers\Generate;
use App\Helpers\Location;
use App\Project;
use Carbon\Carbon;

class Link extends Model
{
    use SoftDeletes;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $fillable = ['name', 'domain', 'url', 'is_active', 'is_conditional', 'link_type_id'];

	protected $hidden = ['id'];
}
