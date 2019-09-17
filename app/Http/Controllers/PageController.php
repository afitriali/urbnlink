<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

	public function index(Project $project)
	{
		$this->authorize('workOn', $project);

		$pages = $project->pages()->get();

		return view('page.index', compact('project', 'pages'));
	}
}
