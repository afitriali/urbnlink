<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Link\Link;
use App\Domain;
use App\Project;
use App\Rules\WebsiteExists;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['respondWithError', 'checkName', 'checkUrl', 'summary']]);
    }

	/**
	 * Forward error message to view
	 *
	 * @param string $action
	 * @param array $errors
	 * @return Response
	 */
	public function respondWithError($action, $errors)
	{
		return response()->json([
			$action => false,
			'errors' => $errors->toArray()
		]);
	}

	public function checkName(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => ['required', 'min:3', 'max:40', 'alpha_num', 'unique:links,name,NULL,links,domain,'.($request->input('domain') ?? env('DEFAULT_SHORT_DOMAIN', 'ur.bn'))],
		]);

		if ($validator->fails()) {
			return $this->respondWithError('available', $validator->errors());
		}

		return response()->json(['available' => true]);
	}

	public function checkUrl(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'url' => ['required', 'regex:/^(http|https):\/\//', new WebsiteExists]
		]);

		if ($validator->fails()) {
			return $this->respondWithError('available', $validator->errors());
		}

		return response()->json(['available' => true]);
	}

	public function create(Project $project)
	{
		$this->authorize('workOn', $project);
		$domains = $project->domains()->get();

		return view('link/create', compact('project', 'domains'));
	}

	public function store(Project $project, Request $request)
	{
		$this->authorize('workOn', $project);

		$domain = $request->input('domain');
		if ($domain !== null) {
			$d = Domain::hasName($domain)->isVerified()->first();
			if ($d) {
				$this->authorize('useDomain', $d);
			} else {
				abort(403);
			}
		}

		$request->validate([
			'name' => [
				'nullable',
				'min:3',
				'max:40',
				'alpha_num',
				'unique:links,name,NULL,links,domain,'.($request->input('domain') ?? env('DEFAULT_SHORT_DOMAIN', 'ur.bn'))
			],
			'url' => [
				'required',
				'regex:/^(http|https):\/\//',
				new WebsiteExists
			]
		]);

		$link = $project->links()->create([
			'name' => $request->input('name'),
			'domain' => $request->input('domain'),
			'url' => $request->input('url'),
			'link_type_id' => $request->input('link_type_id')
		]);

		$success = '👍 You created a nice link!';
		return redirect($project->name.'/link/'.$link->domain.'/'.$link->name)->with('success', $success);
	}

	public function show(Project $project, $domain, Link $link)
	{
		$this->authorize('workOn', $project);
		$stats = $link->getStatistics(); 

		return view('link/show', compact('link', 'project', 'stats'));
	}
}
