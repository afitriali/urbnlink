@component('mail::message')
# You have been added to a project {{ $project->name }}

You have been added to project.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
