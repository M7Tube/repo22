<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait InspectionFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function inProgressSearch(Builder $builder, $value)
    {
        return $builder->where('name', 'like', '%' . $value . '%')->orWhere('desc', 'like', '%' . $value . '%');
    }
    public function ComplateSearch(Builder $builder, $value)
    {
        return $builder->where('name', 'like', '%' . $value . '%')->orWhere('desc', 'like', '%' . $value . '%');
    }
}
