<?php

namespace App\Data\Models\Base;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use ResourcefulTrait;

    const INCLUDE_ARCHIVED = 1;

    const RETURN_NULL_IF_NOT_FOUND = 2;

    /**
     * Resolve the query variable
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name == "query") {
            return $this;
        }

        return parent::__get($name);
    }
}