<?php

use Illuminate\Support\Arr;

/**
 * Returns the route parameter by the slug
 *
 * @param $slug
 * @return string
 */
function get_request_id($slug)
{
    return Arr::get(Route::current()->parameters(), $slug);
}