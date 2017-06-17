<?php
namespace Mage2\Framework\System\Middleware;

use Closure;
use Mage2\Framework\Search\Facades\Search;

class PageIndexer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $uri = $request->getRequestUri();

        Search::indexed($uri);

        return $next($request);
    }
}
