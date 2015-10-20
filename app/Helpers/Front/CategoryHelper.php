<?php

class Category
{

    public static function renderCategoryTree($categoryTree)
    {

        $html = "";
        foreach ($categoryTree as $catId => $category) {

            if (!is_array($category)) {
                $html .= "<li>";
                $html .= "<a href='" . url('/category/' . $category->slug) . "' title='{$category->name}'>{$category->name}</a>";
                $html .= '</li>';

            } else {

                $html .= "<li class='dropdown'>";
                $html .= "<a href='" . url('/category/' . $category[0]->slug) . "'  titles='{$category[0]->name}'>{$category[0]->name}<span class='dropdown-togggle' data-toggle='dropdown'><span class='caret'></span></span></a>";
                $html .= "<ul class='dropdown-menu sub-menu'>";
                $html .= Category::renderCategoryTree($category['child']);
                $html .= "</ul>";
                $html .= '</li>';
            }
        }
        return $html;
    }

}