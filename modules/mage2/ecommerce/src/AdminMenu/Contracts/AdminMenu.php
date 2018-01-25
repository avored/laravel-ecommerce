<?php

namespace Mage2\Ecommerce\AdminMenu\Contracts;

interface AdminMenu {
    /**
     * Get/Set AdminMenu Key
     * @return string $key
     */
    public function key();


    /**
     * Get/Set AdminMenu Label
     * @return string $label
     */
    public function label();

    /**
     * Get/Set AdminMenu Route Name
     * @return string $routeName
     */
    public function route();

}