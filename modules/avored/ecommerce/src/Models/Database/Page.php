<?php

namespace AvoRed\Ecommerce\Models\Database;

use Illuminate\Support\Facades\Blade;
use AvoRed\Framework\Widget\Facade as Widget;

class Page extends BaseModel
{
    protected $fillable = ['name', 'slug', 'content', 'meta_title', 'meta_description'];

    protected $contentTags = ['{{', '}}'];


    public function getContentAttribute($content)
    {
        $pattern = sprintf('/(@)?%s\s*(.+?)\s*%s(\r?\n)?/s', $this->contentTags[0], $this->contentTags[1]);

        $callback = function ($matches) {

            $whitespace = empty($matches[3]) ? '' : $matches[3] . $matches[3];
            $widget = Widget::get($matches[2]);
            $widgetContent = $widget->render();

            return $matches[1] ? substr($matches[0], 1) : "{$widgetContent}{$whitespace}";
        };

        return preg_replace_callback($pattern, $callback, $content);
    }

    public function getContent()
    {
        return $this->attributes['content'];
    }
}
