<?php

namespace Mage2\Framework\Foundation\Providers;

use Illuminate\Support\AggregateServiceProvider;
use Mage2\Framework\Image\ImageServiceProvider;
use Mage2\Framework\Module\ModuleServiceProvider;
use Mage2\Framework\Search\SearchServiceProvider;
use Mage2\Framework\AdminMenu\AdminMenuServiceProvider;
use Mage2\Framework\Theme\ThemeServiceProvider;
use Mage2\Framework\Shipping\ShippingServiceProvider;
use Mage2\Framework\Payment\PaymentServiceProvider;
use Mage2\Framework\DataGrid\DataGridServiceProvider;
use Mage2\Framework\Configuration\ConfigurationServiceProvider;
use Mage2\Framework\Form\FormServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;


class Mage2ServiceProvider extends AggregateServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    protected $providers = [
        AuthServiceProvider::class,
        FormServiceProvider::class,
        ConfigurationServiceProvider::class,
        DataGridServiceProvider::class,
        PaymentServiceProvider::class,
        ShippingServiceProvider::class,
        ThemeServiceProvider::class,
        AdminMenuServiceProvider::class,
        ModuleServiceProvider::class,
        SearchServiceProvider::class,
        ImageServiceProvider::class,
    ];

}
