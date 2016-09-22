<?php

/**
 * Get the first request id
 */
function get_request_id()
{
    $ids = \Session::get('request_ids');

    $id = array_pop($ids);

    \Session::set('request_ids', $ids);

    return $id;
}