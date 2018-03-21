<?php
namespace AvoRed\Ecommerce\Repository;

use AvoRed\Framework\Repository\AbstractRepository;
use AvoRed\Ecommerce\Models\Database\Page as PageModel;

class Page extends AbstractRepository {


    public function model() {
        return new PageModel();
    }


    /**
     * Find the Page by Id
     *
     * @param integer $id
     * @return \AvoRed\Ecommerce\Models\Database\Page $page
     */
    public function findPageById($id):PageModel {
        return $this->model()->find($id);
    }

    /**
     * Find the Page by Slug
     *
     * @param string $slug
     * @return \AvoRed\Ecommerce\Models\Database\Page $page
     */
    public function findPageBySlug($slug):PageModel {
        return $this->model()->whereSlug($slug)->first();
    }
}