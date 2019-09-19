<?php

namespace App\Observers;

use App\Helpers\Generate;
use App\Link\Link;

class LinkObserver
{
    /**
     * Handle the link link "created" event.
     *
     * @param  \App\LinkLink  $linkLink
     * @return void
     */
    public function created(Link $link)
    {
        $link->slug = Generate::slug($link->id);
        $link->name = $link->name ?? $link->slug;
        $link->domain = $link->domain ?? env('DEFAULT_SHORT_DOMAIN', 'ur.bn');
        $link->link_type_id = $link->link_type_id ?? 10;
        $link->save();
    }
}
