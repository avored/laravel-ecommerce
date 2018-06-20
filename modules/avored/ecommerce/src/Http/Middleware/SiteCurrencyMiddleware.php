<?php

namespace AvoRed\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Ecommerce\Models\Contracts\SiteCurrencyInterface;

class SiteCurrencyMiddleware
{

    /**
     * 
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $repository;

     /**
     * 
     * @var \AvoRed\Framework\Models\Repository\SiteCurrencyRepository
     */
    protected $curRep;

    /**
     * Construct to setup Repository 
     * 
     */
    public function __construct(ConfigurationInterface $rep, SiteCurrencyInterface $curRep)
    {
        $this->repository   = $rep;
        $this->curRep       = $curRep;
        
    }
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(null === $request->get('currency_code')  && null !== Session::get('currency_code')) {
            return $next($request);
        }
        $currencyCode = $request->get('currency_code');

        if(null === $currencyCode) {
            $configCurrency = $this->repository->getValueByKey('general_site_currency');
            $siteCurrencyModel = $this->curRep->find($configCurrency);
           
            $currencyCode = $siteCurrencyModel->code;
        } 
        Session::put('currency_code', $currencyCode);
       
        return $next($request);
    }
}
