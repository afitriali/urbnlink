<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ProjectMemberAdded;
use App\Project;
use App\User;
use Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

	public function index()
	{
		$projects = auth()->user()->projects()->get();

		return view('project.index', compact('projects'));
	}

	public function create()
	{
		$this->authorize('create', new Project);

		return view('project.create');
	}

	public function store(Request $request)
	{
		$this->authorize('create', new Project);

		$request->validate([
			'name' => [
				'required',
				'max:40',
				'alpha_dash',
				'unique:projects,name'
			],
			'description' => [
				'max:160',
			]
		]);
		
		$project = auth()->user()->ownProjects()->create([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);

		$success = '🎉 You created a new project!';
		return redirect($project->name)->with('success', $success);
	}
	
	public function settings(Project $project)
	{
		$this->authorize('workOn', $project);

		$domains = $project->domains()->get();
		$links = $project->links()->get();

		return view('project.settings', compact('project', 'domains', 'links'));
	}

	public function update(Project $project, Request $request)
	{
		$this->authorize('manage', $project);

		$request->validate([
			'name' => [
				'required',
				'max:40',
				'alpha_dash',
				'unique:projects,name,'.$project->id.',id',
			],
			'description' => [
				'max:160',
			]
		]);
		
		$project->update([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);

		$success = 'Project Updated';

		return redirect($project->name.'/settings')->with('success', $success);
	}

	public function addMember(Request $request)
	{
		$this->authorize('manage', $project);

		$project = Project::find($request->input('project'));
		$user = User::where('email', $request->input('email'))->first();

		$validator = Validator::make($request->all(), [
			'project' => [
				'required',
				'exists:projects,id',
				'unique:project_members,project_id,NULL,project_members,user_id,'.($user == null ? null : $user->id)
			],
			'email' => [
				'required',
				'email'
			]
		]);
		
		if ($validator->fails()) {
			return back()->withInput();
		} else if ($user == null) {
			// $project->createInvitation($request->input('email');
		} else {
			$this->authorize('update', $project);
			$project->addMember($user);
		}

		\Mail::to($user->email)->send(
			new ProjectMemberAdded($project)
		);

		return view('success', $data);
	}
}
