<?php

namespace App\Observers;

use App\Project;
use App\Helpers\DomainManager;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $project->members()->attach(auth()->user());

        $domain = $project->domains()->create([
            'name' => strtolower($project->name.'.'.env('PROJECT_DOMAIN')),
            'verified_at' => now()
        ]);	

        $domain->record_id = DomainManager::createRecord($project->name);
        $domain->save();

        return true;
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        $domain = $project
            ->domains()
            ->where('name', 'like', '%'.env('PROJECT_DOMAIN'))
            ->first();

        $domain->name = strtolower($project->name.'.'.env('PROJECT_DOMAIN'));
        $domain->save();

        DomainManager::updateRecord($domain->record_id, $project->name);

        return true;
    }
}
