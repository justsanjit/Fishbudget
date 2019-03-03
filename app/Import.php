<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $guarded = [];

    public function scopeInProgress($builder)
    {
        return $builder->where('status', 'submitted')->orWhere('status', 'mapped');
    }
}
