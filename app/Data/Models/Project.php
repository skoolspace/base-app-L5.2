<?php

namespace App\Data\Models;

use App\Data\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends BaseModel
{
    use SoftDeletes;
    use Traits\BelongsToUser;

    /**
     * Defines the model's table name
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Defines the model fillable attributes
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];

    /**
     * Defines the model's hidden attributes
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Links to it's tasks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}