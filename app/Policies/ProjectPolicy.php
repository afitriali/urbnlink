<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;
    
    public function workOn(User $user, Project $project)
    {
        return $project->members()->where('user_id', $user->id)->exists();
    }

    public function create(User $user)
    {
        return ($user->ownProjects()->count() + 1 <= env('PROJECT_LIMIT') || $user->is_pro);
    }

    public function manage(User $user, Project $project)
    {
        return $project->admin_id === $user->id;
    }
}
