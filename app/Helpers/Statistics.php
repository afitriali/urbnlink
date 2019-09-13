<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Statistics
{
	public static function link($link_id)
	{
		$stats['today'] = DB::table('hits')
			->where('link_id', $link_id)
			->whereRaw('DATE(created_at) = CURDATE()')
			->count();

		$stats['week'] = DB::table('hits')
			->where('link_id', $link_id)
			->whereRaw('DATE(created_at) > DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
			->count();

		$hits = DB::table('hits')
			->select(DB::raw('count(*) as count, DATE(created_at) as created'))
			->where('link_id', $link_id)
			->whereRaw('DATE(created_at) > DATE_SUB(CURDATE(), INTERVAL 30 DAY)')
			->groupBy('created')
			->get();

		$referrers = DB::table('hits')
			->select(DB::raw('count(*) as count, referrer'))
			->where('link_id', $link_id)
			->groupBy('referrer')
			->orderBy('count', 'desc')
			->take(10)
			->get();

		$countries = DB::table('hits')
			->select(DB::raw('count(*) as count, country'))
			->where('link_id', $link_id)
			->groupBy('country')
			->orderBy('count', 'desc')
			->take(10)
			->get();

		$pages = DB::table('hits')
			->select(DB::raw('count(*) as count, page'))
			->where('link_id', $link_id)
			->groupBy('page')
			->orderBy('count', 'desc')
			->take(10)
			->get();

		foreach ($hits as $day) {
			$days[$day->created] = $day->count;
		}

		$day = Carbon::now()->subDay(29);
		while ($day <= Carbon::now()) {
			$stats['hits'][$day->format('jS F Y')] = $days[$day->format('Y-m-d')] ?? 0;
			$day->addDay();
		}

		foreach ($referrers as $referrer) {
			$stats['referrers'][$referrer->referrer] = $referrer->count;
		}

		foreach ($countries as $country) {
			$stats['country'][$country->country] = $country->count;
		}

		foreach ($pages as $page) {
			$stats['page'][$page->page] = $page->count;
		}

		return $stats;
	}
}
