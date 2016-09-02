<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Mage2\Admin\Eloquents\Repository\WebsiteRepository;
use Illuminate\Support\Facades\Cache;
class Website
{
    /**
     * @var CategoryRepository
     */
    protected $websiteRepository;

    public function __construct(WebsiteRepository $repository){
        $this->websiteRepository = $repository;
        //parent::__construct();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $host = str_replace("http://","", $request->getUriForPath(""));
        $host = str_replace("https://","", $host);


        $cacheKey = "default_website_middleware_query";

        if(Cache::has($cacheKey)) {
            $website = Cache::get($cacheKey);
        } else {
            $website = $this->websiteRepository->where('host', '=', $host)->get()->first();
            Cache::put($cacheKey,$website,$minute = 100);
        }

        Session::put('website_id', $website->id);

        if($website->is_default == 1) {
            Session::put('is_default_website', true);
            Session::put('default_website_id', $website->id);
        } else {
            $defaultWebsite = $this->websiteRepository->where('is_default','=',1)->get()->first();

            Session::put('is_default_website', false);
            Session::put('default_website_id', $defaultWebsite->id);

        }



        return $next($request);
    }
}
