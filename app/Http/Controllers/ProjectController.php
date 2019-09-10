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

	public function store(Request $request) {
		$project = auth()->user()->Projects()->create([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);

		$project->addMember(auth()->user());

		return view('success', $data);
	}
	
    public function addMember(Request $request) {
		$this->authorize('update', $this);

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
			$project->addMember($user);
		}

		\Mail::to($user->email)->send(
			new ProjectMemberAdded($project)
		);

		return view('success', $data);
	}
}
