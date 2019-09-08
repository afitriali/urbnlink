<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\Generate;
use App\Helpers\Traffic;
use App\Helpers\Statistics;

class Link extends Model
{
	use SoftDeletes;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $fillable = ['name', 'domain', 'url', 'is_active', 'is_conditional', 'link_type_id'];

	protected $hidden = ['id'];

	public static function create(array $attributes = [])
	{
		$link = static::query()->create($attributes);
		$link->slug = Generate::slug($link->id);
		$link->name = $link->name ?? $link->slug;
		$link->domain = $link->domain ?? env('DEFAULT_SHORT_DOMAIN', 'ur.bn');
		$link->save();

		return $link;
	}

	public function toggleActive()
	{
		$this->is_active = !$this->is_active;
		$this->save();

		return $this->is_active;
	}

	public function toggleConditional()
	{
		$this->is_conditional = !$this->is_conditional;
		$this->save();

		return $this->is_conditional;
	}

	public function registerHit($request)
	{
		$this->hits()->create([
			'country' => Traffic::LocationCountry($request->ip()),
			'agent' => $request->server('HTTP_USER_AGENT'),
			'referrer' => $request->server('HTTP_REFERER') ?? 'http://' . $this->domain . '/',
			'page' => $this->url
		]);
	}

	public function getStatistics()
	{
		$stats = Statistics::link($this->id);
		$stats['total'] = $this->hits->count();

		return $stats;
	}

	public function scopeHasName($query, $name)
	{
		return $query->where('name', $name);
	}

	public function scopeHasSlug($query, $slug)
	{
		return $query->where('slug', $slug);
	}
	
	public function scopeHasDomain($query, $domain)
	{
		return $query->where('domain', $domain);
	}

	public function scopeIsActive($query, $bool = true)
	{
		return $query->where('is_active', $bool);
	}

	public function scopeIsNotBlocked($query, $bool = false)
	{
		return $query->where('is_blocked', $bool);
	}

	public function alternativeLinks()
	{
		return $this->hasMany(AlternativeLink::class)->orderBy('priority');
	}

	public function hits()
	{
		return $this->hasMany(Hit::class);
	}

	public function linkType()
	{
		return $this->belongsTo(LinkType::class);
	}

	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
