<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link\Link;
use App\Link\LinkType;
use App\Link\AlternativeLink;
use App\Link\ConditionType;
use App\Link\Condition;

class ForwardController extends Controller
{
	/**
	 * Forward short URL to original address
	 * @param string
	 * @return mixed
	 */
	public function forward($domain, $name)
	{
		$link = Link::hasName($name)->hasDomain($domain)->isActive()->isNotBlocked()->first() ?? abort(404);
		$link->registerHit(request()); // TO BE MOVED

		if ($link->is_conditional)
		{
			return $this->checkAlternativeLinks($link);
		}

		return $this->{$link->linkType->function}($link->url);
	}

	private function checkAlternativeLinks(Link $link)
	{
		foreach ($link->alternativeLinks as $alternative_link)
		{
			if ($this->checkConditions($alternative_link))
			{
				$link = $alternative_link ?? $link;
				break;
			}
		}

		return $this->{$link->linkType->function}($link->url);
	}

	private function checkConditions(AlternativeLink $alternative_link)
	{
		foreach ($alternative_link->conditions as $condition)
		{
			if(!($this->{$condition->conditionType->function}($condition)))
			{
				return false;
			}
		}

		return true;
	}

	// ConditionType functions
	
	private function isBelowVisitorLimit(Condition $condition)
	{
		return $condition->alternativeLink->link->hits->count() <= $condition->amount;
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
		return redirect()->away('https://api.whatsapp.com/' . $url);
	}
}
