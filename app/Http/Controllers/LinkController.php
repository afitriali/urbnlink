<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Link\Link;
use App\Link\LinkType;
use App\Domain;
use App\Project;
use App\Rules\WebsiteExists;

class LinkController extends Controller
{
	protected $domain_list = ['ur.bn', 'whats.app.bn'];

	public function __construct()
	{
		$this->middleware(['auth', 'verified'], ['except' => ['respondWithError', 'checkName', 'checkUrl', 'summary']]);
	}

	public function index(Project $project)
	{
		$this->authorize('workOn', $project);
		$links = $project->links()->get();
		return view('link.index', compact('project', 'links'));
	}

	public function create(Project $project)
	{
		$this->authorize('createLinkFor', $project);
		$domains = array_merge($this->domain_list, $project->domains()->pluck('name')->toArray());
		$link_types = LinkType::whereNotIn('id', [20])->get();
		return view('link.create', compact('project', 'domains', 'link_types'));
	}

	public function store(Project $project, Request $request)
	{
		$this->authorize('createLinkFor', $project);

		$domain = $request->input('domain');
		if (!in_array($domain, $this->domain_list)) {
			$d = Domain::hasName($domain)->isVerified()->first();
			if ($d) {
				$this->authorize('useDomain', $d);
			} else {
				abort(403);
			}
		}

		if ($request->input('domain') === 'whats.app.bn') {
			$request->merge(['link_type_id' => 30]);
		}

		$validator = Validator::make($request->all(), [
			'name' => [
				'nullable',
				'min:3',
				'max:40',
				'alpha_num',
				'unique:links,name,NULL,links,domain,'.($request->input('domain') ?? env('DEFAULT_SHORT_DOMAIN', 'ur.bn'))
			],
			'link_type_id' => [
				'required',
				'numeric'
			]
		], [
			'integer' => 'The phone number should include only the country code and phone number without plus (+) or any other special characters. whats.app.bn is reserved for whatsApp numbers.'
		]);

		$validator->sometimes('url', [
			'required',
			'regex:/^(http|https):\/\//',
			new WebsiteExists
		], function ($input) {
			return $input->link_type_id == 10; 
		});

		$validator->sometimes('url', [
			'required',
			'integer'
		], function ($input) {
			return $input->link_type_id == 30; 
		});

		if ($validator->fails()) {
			return redirect("/{$project->name}/links/create")
				->withErrors($validator)
				->withInput();
		}

		$link = $project->links()->create([
			'name' => $request->input('name'),
			'domain' => $request->input('domain'),
			'url' => $request->input('url'),
			'link_type_id' => $request->input('link_type_id')
		]);

		$success = '👍 You created a nice link!';
		return redirect($project->name.'/links/'.$link->domain.'/'.$link->name)->with('success', $success);
	}

	public function show(Project $project, $domain, Link $link)
	{
		$this->authorize('workOn', $project);
		$stats = $link->getStatistics(); 
		return view('link.show', compact('link', 'project', 'stats'));
	}

	public function rules(Project $project, $domain, Link $link)
	{
		$this->authorize('workOn', $project);
		return view('link.rules', compact('link', 'project'));
	}

	public function edit(Project $project, $domain, Link $link)
	{
		$this->authorize('workOn', $project);
		$domains = $project->domains()->get();
		return view('link.edit', compact('link', 'project', 'domains'));
	}

	public function update(Project $project, $domain, Link $link, Request $request)
	{
		$this->authorize('workOn', $project);
		$request->request->add(['link_type_id' => $link->link_type_id]);
		$validator = Validator::make($request->all(), [], [
			'integer' => 'The phone number should include only the country code and phone number without plus (+) or any other special characters. whats.app.bn is reserved for whatsApp numbers.'
		]);

		$validator->sometimes('url', [
			'required',
			'regex:/^(http|https):\/\//',
			new WebsiteExists
		], function ($input) {
			return $input->link_type_id === 10; 
		});

		$validator->sometimes('url', [
			'required',
			'integer'
		], function ($input) {
			return $input->link_type_id === 30; 
		});

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		$link->update([
			'url' => $request->input('url'),
			'link_type_id' => $request->input('link_type_id') ?? 10
		]);

		$success = 'Link updated';
		return redirect($project->name.'/links/'.$link->domain.'/'.$link->name)->with('success', $success);
	}

	public function delete(Project $project, $domain, Link $link, Request $request)
	{
		$this->authorize('manage', $project);

		$link->delete();

		$success = $link->domain.'/'.$link->name.' deleted';
		return redirect($project->name)->with('success', $success);
	}
}
