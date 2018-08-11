<?php
namespace AvoRed\Related\Http\ViewComposers;

use AvoRed\Related\Models\Database\RelatedProduct;
use Illuminate\View\View;

class RelatedProductViewComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $model = new RelatedProduct();
        $view->with('related', $model);
    }

}