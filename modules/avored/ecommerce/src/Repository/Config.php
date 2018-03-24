<?php
namespace AvoRed\Ecommerce\Repository;

use AvoRed\Framework\Repository\AbstractRepository;
use AvoRed\Ecommerce\Models\Database\Configuration as ConfigModel;

class Config extends AbstractRepository {


    public function model() {
        return new ConfigModel();
    }


    /**
     * Get the Configuration Value by it's Key Value
     * @param $configKey
     * @return mixed
     */
    public function getConfiguration($configKey) {
        $row = $this->model()->whereConfigurationKey($configKey)->first();

        if(null === $row) {
            return null;
        }
        return $row->configuration_value;
    }

    /**
     * Get the Configuration by it's Key Value
     * @param $configKey
     * @return mixed
     */
    public function findConfigurationByKey($configKey) {
        return $this->model()->whereConfigurationKey($configKey)->first();
    }

}