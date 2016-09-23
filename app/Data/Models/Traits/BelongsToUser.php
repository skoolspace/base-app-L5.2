<?php

namespace App\Data\Models\Traits;
                                                                                                                                
use App\Data\Models\User;

trait BelongsToUser
{
    /**
     * Attach the user's id to the creation of the resource
     *
     * @return void
     */
    public static function bootBelongsToUser()
    {
        static::creating(function ($model) {
            $model->user_id = \API::user()->id;
        });
    }

    /**
     * Attach the user's id to the queries of the resource
     *
     * @return mixed
     */
    public function newQuery()
    {
        $query = parent::newQuery();
        return $query->where(function ($q) {
            return $q->where('user_id', \API::user()->id);
        });
    }

    /**
     * Links to the user who created the resource
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}