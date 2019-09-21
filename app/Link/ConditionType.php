<?php

namespace App\Link;

use Illuminate\Database\Eloquent\Model;

class ConditionType extends Model
{
    public function conditions()
    {
        return $this->hasMany(Condition::class);
    }
}
