<?php
namespace AvoRed\Ecommerce\DataGrid\Columns;

class LinkColumn  extends AbstractColumn {

    /**
     * column type
     *
     * @string
     */
    public $type = "link";


    /**
     * Callable function for the link
     *
     * @string
     */
    public $callback;

    public function __construct($identifier, $options = [], $callback = NULL) {
        parent::__construct($identifier, $options);
        $this->callback = $callback;
    }

    public function executeCallback($row) {
        $return = $this->callback;

        if($row && is_callable($return)) {
            return $return($row);
        }

        return false;
    }
}