<?php

namespace App\Data\Models;

use App\Data\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends BaseModel
{
    use SoftDeletes;
    use Traits\BelongsToProject;

    /**
     * Defines the model's table name
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * Defines the model fillable attributes
     *
     * @var array
     */
    protected $fillable = ['title', 'completed', 'project_id'];

    /**
     * Defines the model's hidden attributes
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Links to the project the task belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}