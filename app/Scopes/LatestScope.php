<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class LatestScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        return $builder->orderBy($model::CREATED_AT, 'desc');
    }
}