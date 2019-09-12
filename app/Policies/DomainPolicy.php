<?php

namespace App\Policies;

use App\User;
use App\Domain;
use Illuminate\Auth\Access\HandlesAuthorization;

class DomainPolicy
{
    use HandlesAuthorization;
    
    public function useDomain(User $user, Domain $domain)
    {
        return $domain->project()->first()->projectMembers()->where('user_id', $user->id)->exists();
    }
}
