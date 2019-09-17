<?php

namespace App\Observers;

use App\Domain;
use App\Helpers\DomainManager;

class DomainObserver
{
    public function deleted(Domain $domain)
    {
        if ($domain->record_id) {
            DomainManager::deleteRecord($domain->record_id);
        }

        return true;
    }
}
