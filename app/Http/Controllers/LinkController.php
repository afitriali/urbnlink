<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Link\Link;
use App\Rules\WebsiteExists;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['respondWithError', 'checkName', 'checkUrl', 'store']]);
		\View::share('site_parameters', [
			'parent_url' => url()->previous()
		]);
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

	public function create() {
		return view('link/create');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => ['min:3', 'max:40', 'alpha_num', 'unique:links,name,NULL,links,domain,'.($request->input('domain') ?? env('DEFAULT_SHORT_DOMAIN', 'ur.bn'))],
			'url' => ['required', 'regex:/^(http|https):\/\//', new WebsiteExists]
		]);

		if ($validator->fails()) {
			return $this->respondWithError('created', $validator->errors());
		}

		$created = Link::create([
			'name' => $request->input('name'),
			'domain' => $request->input('domain'),
			'url' => $request->input('url'),
			'link_type_id' => $request->input('link_type_id')
		]);
		$created->date = $created->created_at->format('jS F Y, g:i a');

		return response()->json(['created' => true]);
	}

	public function getStatistics($domain, $name)
	{
		return Link::hasName($name)->hasDomain($domain)->first()->getStatistics(); 
	}
}
