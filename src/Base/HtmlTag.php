<?php

namespace Metal\Base;

use Closure;

use function Metal\Html\setAttr;

class HtmlTag extends Tag
{
    public function __construct(
        public ?string $dir = null,
        public string $doctype = 'html',
        public array|Tag|string|null|Closure $content = null,
        public string|null $id = null,
        public array|string|null $class = null,
        public ?array $attributes = null,
        bool|\Closure|null $renderCondition = true
    ) {
        if ($dir) setAttr($attributes, 'dir', $dir);

        parent::__construct(
            tagname: 'html',
            content: $content,
            id: $id,
            class: $class,
            attributes: $attributes,
            renderCondition: $renderCondition
        );
    }

    function render(): string
    {
        $render = parent::render();
        if ($this->doctype) {
            return "<!DOCTYPE $this->doctype>$render";
        }

        return $render;
    }
}
