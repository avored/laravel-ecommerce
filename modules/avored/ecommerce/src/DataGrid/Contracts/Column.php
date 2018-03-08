<?php
namespace AvoRed\Ecommerce\DataGrid\Contracts;

interface Column {
    /**
     * Get the column identifier.
     * @return string $identifier
     */
    public function identifier();


    /**
     * Get the column label.
     * @return string $label
     */
    public function label();

    /**
     * Get the column type.
     * @return string $type
     */
    public function type();

    /**
     * Is column sortable?
     * @return string $type
     */
    public function sortable();

}