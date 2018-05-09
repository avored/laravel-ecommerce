<?php

namespace AvoRed\Ecommerce\Models\Database;

use AvoRed\Framework\Widget\Facade as Widget;

class Page extends BaseModel
{
    protected $fillable = ['name', 'slug', 'content', 'meta_title', 'meta_description'];

    protected $contentTags = ['{{', '}}'];

    public function getContentAttribute($content)
    {
        $pattern = sprintf('/(@)?%s\s*(.+?)\s*%s(\r?\n)?/s', $this->contentTags[0], $this->contentTags[1]);

        $callback = function ($matches) {
            $whitespace = empty($matches[3]) ? '' : $matches[3].$matches[3];
            $widget = Widget::get($matches[2]);

            if (method_exists($widget, 'render')) {
                $widgetContent = $widget->render();
            } else {
                //IF method Doesn't Exist it means they uninstall the Widget or module.
                $widgetContent = '';
            }

            return $matches[1] ? substr($matches[0], 1) : "{$widgetContent}{$whitespace}";
        };

        return preg_replace_callback($pattern, $callback, $content);
    }

    public static function options($empty = true) {

        $model = new static();

        $options = $model->all()->pluck('name', 'id');
        if(true === $empty) {
            $options->prepend('Please Select', null);
        }
        return $options;
    }

    public function getContent()
    {
        return $this->attributes['content'];
    }
}
