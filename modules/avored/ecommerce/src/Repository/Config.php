<?php
namespace AvoRed\Ecommerce\Repository;

use AvoRed\Framework\Repository\AbstractRepository;
use AvoRed\Ecommerce\Models\Database\Configuration as ConfigModel;

class Config extends AbstractRepository {


    public function model() {
        return new ConfigModel();
    }


}