<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DomainManager;

class Project extends Model
{
    protected $fillable = ['name', 'description'];

    public function addMember(User $user)
    {
        $this->members()->attach($user);
        return $this;
    }

    public function removeMember(User $user) {
        if ($this->admin() != $user) {
            return $this->members()->detach($user);
        }
        return $this;
    }

    public function createInvitation($email)
    {
        $this->ProjectInvitations()->create([
            'email' => $email
        ]);
        return $this;
    }

    public function deleteInvitation(ProjectInvitation $invitation)
    {
        $this->ProjectInvitations()->delete($invitation);
        return $this;
    }

    public function changeAdmin(User $user) {
        $this->admin()->associate($user);
        $this->save();
        return $this;
    }

    public function delete()
    {
        $domain = $this
            ->domains()
            ->where('name', 'like', '%'.env('PROJECT_DOMAIN'))
            ->first();
        DomainManager::deleteRecord($domain->record_id);
        return parent::delete();
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function links()
    {
        return $this->hasMany(Link\Link::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members');
    }

    public function projectInvitations()
    {
        return $this->hasMany(ProjectInvitation::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function pages()
    {
        return $this->hasMany(Page\Page::class);
    }
}
