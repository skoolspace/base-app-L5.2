<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RetrieveRequestIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $this->prepareUrl($request);

        $this->saveIds($this->retrieveRequestIds($url));

        return $next($request);
    }

    /**
     * Prepare the url into a proper array
     *
     * @param Request $request
     * @return array
     */
    public function prepareUrl(Request $request)
    {
        $attributes = explode("/", $request->getRequestUri());

        // Remove the blank space
        array_shift($attributes);

        // Remove the api
        array_shift($attributes);

        return $attributes;
    }

    /**
     * Retrieve the ids from the url array of values
     *
     * @param array $attributes
     * @return array
     */
    public function retrieveRequestIds(array $attributes)
    {
        $ids = array();

        for ($i = 1; $i < count($attributes); $i += 2) {
            $ids[] = $attributes[$i];
        }

        return $ids;
    }

    /**
     * Save the array of ids to the session storage
     *
     * @param array $ids
     * @return void
     */
    public function saveIds($ids)
    {
        \Session::set('request_ids', $ids);
    }
}
