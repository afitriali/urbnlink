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
		Auth::User()->Projects()->create([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);
	}
	
    public function inviteMember(Request $request) {
		// Only project owner can add member
		// Verify Member is not Owner
		$project = Project::find($request->input('project'));
		$user = User::where('email', $request->input('user'))->first();

		if ($user == null || $user->id == $project->admin_id) {
			return $this->respondWithError('created', 'User is Invalid');
		}

		$validator = Validator::make($request->all(), [
			'project' => [
				'required',
				'exists:projects,id',
				'unique:project_members,project_id,NULL,project_members,user_id,'.$user->id
			],
			'user' => [
				'required',
				'email',
				'exists:users,email'
			]
		]);
		
		if ($validator->fails()) {
			return $this->respondWithError('created', $validator->errors());
		}
		
		$project->inviteMember($user);

		$data['project-name'] = $project->name;

		\Mail::to($user->email)->send(
			new ProjectMemberAdded()
		);

		return response()->json(['invited' => true]);
	}
}
