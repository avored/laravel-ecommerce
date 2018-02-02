<?php

namespace Mage2\Ecommerce\Breadcrumb\Contracts;

interface Breadcrumb {



    /**
     * Get/Set AdminMenu Label
     * @return string $label
     */
    public function label();

    /**
     * Get/Set Breadcrumb Route Name
     * @return string $route
     */
    public function route();



}