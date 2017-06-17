<?php
namespace Mage2\Framework\DataGrid\Columns;

class TextColumn
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
     * DataType of the Columns
     * @string
     */
    public $dataType = "text";


    public function __construct($identifier, $label)
    {
        $this->identifier = $identifier;
        $this->label = $label;
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