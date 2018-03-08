<?php

namespace AvoRed\Ecommerce\AdminMenu\Contracts;

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
     * Get/Set AdminMenu Icon
     * @return string $icon
     */
    public function icon();

    /**
     * Get/Set AdminMenu Route Name
     * @return string $routeName
     */
    public function route();

}