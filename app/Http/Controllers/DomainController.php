<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
use App\Project;
use App\Link\Link;

class DomainController extends Controller
{
	public function setDefaultLink(Project $project, Domain $domain, Request $request)
	{
		$this->authorize('workOn', $project);

		$request->validate([
			'link' => [
				'nullable',
				'exists:links,id'
			]
		]);

		if ($request->input('link') == "") {
			$domain->defaultLink()->dissociate();
			$domain->save();
		} else {
			$link = Link::findOrFail((int)$request->input('link'));
			$domain->defaultLink()->associate($link);
			$domain->save();
		}

		$success = 'Updated default link for '.$domain->name;
		return redirect($project->name.'/settings')->with('success', $success);
	}
}
