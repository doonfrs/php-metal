<?php

namespace Metal\Html;

use Metal\Base\Tag;

function htmlPage(
    array|Tag|null $head,
    array|Tag|null $body,
    ?string $dir = null,
    ?string $lang = null,
    ?array $attributes = null,
    bool|\Closure|null $renderCondition = true
) {
    $html = array_merge(
        is_array($head) ? $head : [$head],
        is_array($body) ? $body : [$body]
    );

    return html(
        content: $html,
        dir: $dir,
        lang: $lang,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}
