<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;
    
    public function view(User $user, Project $project)
    {
        return $project->ProjectMembers()->where('user_id', $user->id)->exists();
    }

    public function create(User $user)
    {
        return ($user->projects()->count() + 1 <= env('PROJECT_LIMIT') || $user->is_pro);
    }

    public function update(User $user, Project $project)
    {
        return $project->admin_id === $user->id && 
            ($user->projects()-count() + 1 <= env('PROJECT_LIMIT') || $user->is_pro);
    }
}
