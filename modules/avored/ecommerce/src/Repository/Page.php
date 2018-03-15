<?php
namespace AvoRed\Ecommerce\Repository;

use AvoRed\Framework\Repository\AbstractRepository;
use AvoRed\Ecommerce\Models\Database\Page as PageModel;

class Page extends AbstractRepository {


    public function model() {
        return new PageModel();
    }


}