<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Helpers\Generate;
use App\Helpers\Traffic;
use App\Project;
use Carbon\Carbon;

class Link extends Model
{
	use SoftDeletes;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $fillable = ['name', 'domain', 'url', 'is_active', 'is_conditional', 'link_type_id'];

	protected $hidden = ['id'];

	public static function create(array $attributes = [], Project $project = null)
	{
		$link = static::query()->create($attributes);
		$link->slug = Generate::sprinkleRandomChar(Generate::decimalToBase($link->id, 62));
		$link->name = $link->name ?? $link->slug;

		if ($project)
		{
			$link->project()->associate->project($project);
		}

		$link->save();

		return $link;
	}

	public function toggleActive()
	{
		$this->is_active = !$this->is_active;
		$this->save();
	}

	public function toggleConditional()
	{
		$this->is_conditional = !$this->is_conditional;
		$this->save();
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

	public function statistics()
	{
		$stats['total'] = $this->hits->count();

		$hits = DB::table('hits')
			->select(DB::raw('count(*) as count, DATE(created_at) as created'))
			->where('link_id', $this->id)
			->whereRaw('DATE(created_at) > DATE_SUB(CURDATE, INTERVAL 30 DAY)')
			->groupBy('created')
			->get();

		foreach ($hits as $day)
		{
			$days[$day->created] = $day->count;
		}

		$day = Carbon::now()->subDay(29);

		while ($day <= Carbon::now())
		{
			$stats['hits'][$day->format('jS F Y')] = $days[$day->format('Y-m-d')] ?? 0;
			$day->addDay();
		}

		$stats['week'] = DB::table('hits')
			->where('link_id', $this->id)
			->whereRaw('DATE(created_at) > DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
			->count();

		$stats['today'] = DB::table('hits')
			->where('link_id', $this->id)
			->whereRaw('DATE(created_at) = CURDATE()')
			->count();

		$referrers = DB::table('hits')
			->select(DB::raw('count(*) as count, referrer'))
			->where('link_id', $this->id)
			->groupBy('referrer')
			->orderBy('count', 'desc')
			->take(10)
			->get();

		foreach ($referrers as $referrer)
		{
			$stats['referrers'][$referrer->referrer] = $referrer->count;
		}

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
