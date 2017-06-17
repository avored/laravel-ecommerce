<?php
namespace Mage2\Framework\DataGrid\Columns;

class LinkColumn
{
    /**
     * identifier of the Columns
     *
     * @string
     */
    public $identifier;


    /**
     * Label of the Columns
     * @string
     */
    public $label;

    /**
     * identifier of the Columns
     *
     * @string
     */
    public $dataType = "link";


    /**
     * identifier of the Columns
     *
     * @string
     */
    public $callback;

    public function __construct($identifier, $label, $callback)
    {
        $this->identifier = $identifier;
        $this->label = $label;
        $this->callback = $callback;
    }

    public function executeCallback($row)
    {
        $return = $this->callback;
        if ($row && is_callable($return))
            return $return($row);
        return false;
    }


    public function getLabel()
    {
        return $this->label;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getDataType()
    {

        return $this->dataType;
    }

}