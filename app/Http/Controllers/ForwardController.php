<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
use App\Link\Link;
use App\Link\LinkType;
use App\Link\AlternativeLink;
use App\Link\ConditionType;
use App\Link\Condition;

class ForwardController extends Controller
{
	public function index($domain)
	{
		$domain = Domain::hasName($domain)->isVerified()->first();

		if ($domain == null || $domain->defaultLink()->first() == null) {
			return redirect()->away(env('APP_URL'));
		}

		$link = $domain->defaultLink()->first();

		return $this->forward($link->domain, $link->name);
	}

	public function preview($domain, $name)
	{
		$link = Link::hasName($name)->hasDomain($domain)->isActive()->isNotBlocked()->first() ?? abort(404);

		if ($link->is_conditional) {
			$link = $this->checkAlternativeLinks($link);
		}

		$stats = $link->getStatistics(); 
		return view('link/preview', compact('link', 'stats'));
	}

	/**
	 * Forward short URL to original address
	 * @param string
	 * @return mixed
	 */
	public function forward($domain, $name)
	{
		$link = Link::hasName($name)->hasDomain($domain)->isActive()->isNotBlocked()->first() ?? abort(404);

		if ($link->is_conditional) {
			$link = $this->checkAlternativeLinks($link);
		}

		$link->registerHit(request());
		return $this->{$link->linkType->function}($link->url);
	}

	private function checkAlternativeLinks(Link $link)
	{
		foreach ($link->alternativeLinks as $alternative_link) {
			if ($this->checkConditions($alternative_link)) {
				$link->url = $alternative_link->url;
				$link->link_type_id = $alternative_link->link_type_id;
				break;
			}
		}

		return $link;
	}

	private function checkConditions(AlternativeLink $alternative_link)
	{
		foreach ($alternative_link->conditions as $condition) {
			if (!($this->{$condition->conditionType->function}($condition))) {
				return false;
			}
		}
		return true;
	}

	// ConditionType functions

	private function isBelowVisitorLimit(Condition $condition)
	{
		return $condition->alternativeLink->link->hits->count() < $condition->values['amount'];
	}

	// LinkType functions

	private function forwardToUrl($url)
	{
		return redirect()->away($url);
	}

	private function loadPage($url)
	{
		return 'URBN Page';
	}

	private function forwardToWhatsapp($url)
	{
		return redirect()->away('https://api.whatsapp.com/send?phone=' . $url);
	}
}
