<?php

namespace App\Data\Models\Traits;

use App\Data\Models\Project;

trait BelongsToProject
{
    /**
     * Attach the parent's id to the creation of the resource
     *
     * @return void
     */
    public static function bootBelongsToProject()
    {
        static::creating(function ($model) {
            $model->project_id = Project::findOrFail(get_request_id())->id;
        });
    }

    /**
     * Attach the parent's id to the queries of the resource
     *
     * @return mixed
     */
    public function newQuery()
    {
        $query = parent::newQuery();
        return $query->where(function ($q) {
            return $q->where('project_id', Project::findOrFail(get_request_id())->id);
        });
    }
}