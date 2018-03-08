<?php
namespace AvoRed\Ecommerce\Models\Database;

class Configuration extends BaseModel
{
    protected $fillable = ['configuration_key', 'configuration_value'];

    public function getValue($key)
    {

        $row = $this->where('configuration_key', '=', $key)->first();
        if ($row != null) {
            return $row->configuration_value;
        }

        return null;
    }

    public static function getConfiguration($key)
    {
        $model = new static;
        return $model->getValue($key);
    }

    public static function setConfiguration($key,$value)
    {
        $model = new static;
        $row = $model->where('configuration_key', '=', $key)->first();
        return $row->update(['configuration_value' => $value]);
    }

    /**
     * Determine if an attribute or relation exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __get($key)
    {
        $val = parent::__get($key);
        if (null !== $val) {
            return $val;
        }

        $val = $this->getValue($key);

        if (null !== $val) {
            return $val;
        }

        return null;
    }
}
