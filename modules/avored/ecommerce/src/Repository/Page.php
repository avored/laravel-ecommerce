<?php

namespace AvoRed\Ecommerce\Repository;

use AvoRed\Framework\Repository\AbstractRepository;
use AvoRed\Ecommerce\Models\Database\Page as PageModel;

class Page extends AbstractRepository
{
    public function model()
    {
        return new PageModel();
    }

    /**
     * Get Page Options for drop down.
     *
     * @return \Illuminate\Support\Collection $countryOptions
     */
    public function pageOptions()
    {
        $pageOptions = $this->model()->all()->pluck('name', 'id');
        $pageOptions->prepend('Please Select', null);

        return $pageOptions;
    }

    /**
     * Find the Page by Id.
     *
     * @param int $id
     * @return \AvoRed\Ecommerce\Models\Database\Page $page
     */
    public function findPageById($id):PageModel
    {
        return $this->model()->find($id);
    }

    /**
     * Find the Page by Slug.
     *
     * @param string $slug
     * @return \AvoRed\Ecommerce\Models\Database\Page $page
     */
    public function findPageBySlug($slug):PageModel
    {
        return $this->model()->whereSlug($slug)->first();
    }
}
