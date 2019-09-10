<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ProjectMemberAdded;
use App\Project;
use App\User;
use Validator;

class ProjectController extends Controller
{
	public function respondWithError($action, $errors)
	{
		return response()->json([
			$action => false,
			'errors' => !is_string($errors) ? $errors->toArray() : $errors
		]);
	}
	
	public function create(Request $request) {
		$project = Auth::User()->Projects()->create([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);

		$project->addMember(Auth::User());
	}
	
    public function addMember(Request $request) {
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
			return $this->respondWithError('created', $validator->errors());
		} else if ($user == null) {
			return response()->json(['invited' => false]);
			// $project->createInvitation($request->input('email');
		} else {
			$project->addMember($user);
		}

		\Mail::to($user->email)->send(
			new ProjectMemberAdded($project)
		);

		return response()->json(['invited' => true]);
	}
}
