<?php

namespace Metal\Html;

use Closure;
use Metal\Base\HtmlTag;
use Metal\Base\Tag;

function html(
    array|Tag|string|Closure|null $content,
    string|null $id = null,
    ?string $dir = null,
    string $doctype = 'html',
    array|string|null $class = null,
    ?array $attributes = null,
    ?string $lang = null,
    bool|\Closure|null $renderCondition = true
): Tag {
    if ($lang) setAttr($attributes, 'lang', $lang);

    return new HtmlTag(
        content: $content,
        id: $id,
        doctype: $doctype,
        dir: $dir,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function a(
    array|Tag|string|Closure|null $content = null,
    ?string $href = null,
    ?string $target = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($href) setAttr($attributes, 'href', $href);
    if ($target) setAttr($attributes, 'target', $target);
    if ($name) setAttr($attributes, 'name', $name);


    return new Tag(
        tagname: 'a',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function img(
    ?string $src = null,
    string|int|null $width = null,
    string|int|null $height = null,
    ?string $alt = null,
    /**
     * eager or lazy https://www.w3schools.com/tags/att_img_loading.asp
     */
    ?string $loading = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($src) setAttr($attributes, 'src', $src);
    if ($alt) setAttr($attributes, 'alt', $alt);
    if ($width) setAttr($attributes, 'width', $width);
    if ($height) setAttr($attributes, 'height', $height);
    if ($loading) setAttr($attributes, 'loading', $loading);

    return new Tag(
        tagname: 'img',
        id: $id,
        class: $class,
        attributes: $attributes,
        selfClosing: true,
        renderCondition: $renderCondition
    );
}




function iframe(
    ?string $src = null,
    ?string $srcDoc = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($src) setAttr($attributes, 'src', $src);
    if ($srcDoc) setAttr($attributes, 'srcdoc', $srcDoc);

    return new Tag(
        tagname: 'iframe',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function audio(
    array|Tag|string|Closure|null $sources = null,
    string $autoplay = null,
    string $loop = null,
    string $muted = null,
    bool $control = null,
    string $preload = null,
    ?string $src = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($autoplay) setAttr($attributes, 'autoplay', true);
    if ($control) setAttr($attributes, 'control', true);
    if ($loop) setAttr($attributes, 'loop', true);
    if ($muted) setAttr($attributes, 'muted', true);
    if ($preload) setAttr($attributes, 'preload', true);
    if ($src) setAttr($attributes, 'src', true);

    return new Tag(
        tagname: 'audio',
        content: $sources,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function body(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    string|array|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'body',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function br(
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'br',
        attributes: $attributes,
        id: $id,
        class: $class,
        selfClosing: true,
        renderCondition: $renderCondition
    );
}


function nav(
    array|Tag|string|Closure|null $content,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'nav',
        content: $content,
        attributes: $attributes,
        id: $id,
        class: $class,
        renderCondition: $renderCondition
    );
}


function ol(
    array|Tag|string|Closure|null $content,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'ol',
        content: $content,
        attributes: $attributes,
        id: $id,
        class: $class,
        renderCondition: $renderCondition
    );
}


function ul(
    array|Tag|string|Closure|null $content,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'ul',
        content: $content,
        attributes: $attributes,
        id: $id,
        class: $class,
        renderCondition: $renderCondition
    );
}

function li(
    array|Tag|string|Closure|null $content,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'li',
        content: $content,
        attributes: $attributes,
        id: $id,
        class: $class,
        renderCondition: $renderCondition
    );
}


function buttonButton(
    array|Tag|string|Closure|null $content = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?bool $disabled = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'button');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($name) setAttr($attributes, 'name', $name);

    return new Tag(
        tagname: 'button',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function buttonSubmit(
    array|Tag|string|Closure|null $content = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'submit');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($name) setAttr($attributes, 'name', $name);

    return new Tag(
        tagname: 'button',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function button(
    array|Tag|string|Closure|null $content = null,
    ?string $type = 'button',
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($type) setAttr($attributes, 'type', $type);
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($name) setAttr($attributes, 'name', $name);


    return new Tag(
        tagname: 'button',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function span(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'span',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function legend(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'legend',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function fieldset(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'fieldset',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



/**
 * if you want to use a tag as container but not to be rendered
 * function mycustomTag():Tag{
 *     return emptytag([div('1'),div('2')]);
 * }
 * Metal::render(h1(mycustomTag()));
 * you will have <div>1</div><div>2</div> without container,
 * another solution is to return array, but in this case you can not use the widget function as a standalone Tag
 */
function emptytag(
    array|Tag|string|Closure|null $content = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: false,
        content: $content,
        renderCondition: $renderCondition
    );
}

function tag(
    string $tagname,
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: $tagname,
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function div(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'div',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function h1(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'h1',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function h2(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'h2',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function h3(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'h3',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function h4(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'h4',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function h5(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'h5',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}
function h6(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'h6',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function option(
    array|Tag|string|Closure|null $content = null,
    string|int|float|null $value = null,
    ?bool $selected = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {

    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($selected) setAttr($attributes, 'selected', true);

    return new Tag(
        tagname: 'option',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}





function hr(
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'hr',
        id: $id,
        class: $class,
        attributes: $attributes,
        selfClosing: true,
        renderCondition: $renderCondition
    );
}




function datalist(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'dataist',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function head(
    ?string $title = null,
    array|Tag|null $meta = null,
    array|Tag|null $scripts = null,
    array|Tag|null $styles = null,
    array|Tag|string|Closure|null $content = null,
    array|Tag|string|null $append = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    initContent($content);

    if ($title) array_unshift($content, title($title));
    if ($meta) $content = array_merge($content, is_array($meta)  ? $meta : [$meta]);
    if ($scripts) $content = array_merge($content, is_array($scripts)  ? $scripts : [$scripts]);
    if ($styles) $content = array_merge($content, is_array($styles)  ? $styles : [$styles]);
    if ($append) $content = array_merge($content, is_array($append)  ? $append : [$append]);

    return new Tag(
        tagname: 'head',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function inputText(
    ?bool $required = null,
    ?string $name = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?string $placeholder = null,
    ?bool $disabled = null,
    ?bool $autocomplete = null,
    ?string $list = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'text');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($list) setAttr($attributes, 'list', $list);
    if ($placeholder) setAttr($attributes, 'placeholder', $placeholder);
    if ($readonly) setAttr($attributes, 'readonly', true);


    if ($autocomplete !== null) setAttr($attributes, 'autocomplete', $autocomplete ? 'on' : 'off');

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function select(
    ?string $name = null,
    string|int|float|null $value = null,
    ?bool $required = null,
    ?bool $readonly = null,
    ?string $placeholder = null,
    ?bool $disabled = null,
    ?bool $multiple = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'text');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($placeholder) setAttr($attributes, 'placeholder', $placeholder);
    if ($readonly) setAttr($attributes, 'readonly', true);
    if ($multiple) setAttr($attributes, 'multiple', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function input(
    ?string $min = null,
    ?string $max = null,
    ?string $type = null,
    ?bool $required = null,
    ?string $name = null,
    string|int|float|null $value = null,
    ?string $list = null,
    ?string $src = null,
    ?bool $readonly = null,
    ?string $placeholder    = null,
    ?bool $multiple = null,
    ?bool $checked = null,
    ?bool $disabled = null,
    ?string $accept = null,
    ?bool $autocomplete = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($type)  setAttr($attributes, 'type', $type);
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($checked) setAttr($attributes, 'checked', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($min) setAttr($attributes, 'min', $min);
    if ($max) setAttr($attributes, 'max', $max);
    if ($placeholder) setAttr($attributes, 'placeholder', $placeholder);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($src) setAttr($attributes, 'src', $src);
    if ($accept) setAttr($attributes, 'accept', $accept);
    if ($multiple) setAttr($attributes, 'multiple', true);
    if ($readonly) setAttr($attributes, 'readonly', true);
    if ($list) setAttr($attributes, 'list', $list);


    if ($autocomplete !== null) setAttr($attributes, 'autocomplete', $autocomplete ? 'on' : 'off');

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputCheckbox(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $checked = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'checkbox');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($checked) setAttr($attributes, 'checked', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputEmail(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'email');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputFile(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    ?string $accept = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'file');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);
    if ($accept) setAttr($attributes, 'accept', $accept);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function inputDate(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'date');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputColor(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'color');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function inputHidden(
    ?string $name = null,
    string|int|float|null $value = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'hidden');
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function inputMonth(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'month');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputRange(
    string|int|float|null $value = null,
    ?bool $disabled = null,
    ?string $name = null,
    ?float $min = null,
    ?float $max = null,
    ?float $step = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'range');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);


    if ($min) setAttr($attributes, 'min', $min);
    if ($max) setAttr($attributes, 'max', $max);
    if ($step) setAttr($attributes, 'step', $step);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputPassword(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'password');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputReset(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'reset');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputSearch(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'search');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function inputWeek(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'week');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function inputUrl(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'url');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputTime(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'time');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function inputTel(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'tel');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function inputSubmit(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'submit');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function inputNumber(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $disabled = null,
    ?string $name = null,
    ?int $min = null,
    ?int $max = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'number');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);
    if ($min) setAttr($attributes, 'min', $min);
    if ($max) setAttr($attributes, 'max', $max);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function inputRadio(
    ?bool $required = null,
    string|int|float|null $value = null,
    ?bool $readonly = null,
    ?bool $checked = null,
    ?bool $disabled = null,
    ?string $name = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    setAttr($attributes, 'type', 'radio');
    if ($disabled) setAttr($attributes, 'disabled', true);
    if ($checked) setAttr($attributes, 'checked', true);
    if ($required) setAttr($attributes, 'required', true);
    if ($name) setAttr($attributes, 'name', $name);
    if ($value !== null) setAttr($attributes, 'value', $value);
    if ($readonly) setAttr($attributes, 'readonly', true);

    return new Tag(
        tagname: 'input',
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function link(
    string $href,
    string $rel,
    ?string $media = null,
    string|null $id = null,
    string|null $type = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($href) setAttr($attributes, 'href', $href);
    if ($rel) setAttr($attributes, 'rel', $rel);
    if ($media) setAttr($attributes, 'media', $media);
    if ($type) setAttr($attributes, 'type', $type);

    return new Tag(
        tagname: 'link',
        attributes: $attributes,
        id: $id,
        class: $class,
        selfClosing: true,
        renderCondition: $renderCondition
    );
}





function meta(
    ?string $name = null,
    ?string $property = null,
    ?string $content = null,
    ?string $charset = null,
    ?string $httpequiv = null,
    array|null $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {

    if ($content) setAttr($attributes, 'content', $content);
    if ($charset) setAttr($attributes, 'charset', $charset);

    if ($name) {
        setAttr($attributes, 'name', $name);
    } elseif ($property) {
        setAttr($attributes, 'property', $property);
    }

    if ($httpequiv) setAttrs($attributes, ['http-equiv' => $httpequiv]);


    return new Tag(
        tagname: 'meta',
        attributes: $attributes,
        selfClosing: true,
        renderCondition: $renderCondition
    );
}


function script(
    ?string $src = null,
    array|Tag|string|Closure|null $content = null,
    ?bool $async = null,
    ?bool $defer = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($src !== null)  setAttr($attributes, 'src', $src);
    if ($defer !== null)  setAttr($attributes, 'defer', $defer);
    if ($async !== null)  setAttr($attributes, 'async', $async);

    return new Tag(
        tagname: 'script',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function center(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'center',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




/**
 * Conditional Display/render for an element
 * Pass the content as Closure, the system will execute the function incase when display = true
 * display also can be callable function, the engine will call this function when the element render reached in elements tree
 * Using Closure is important for performance reason, the engine will only call the class and retrieve the element content if the element need to be rendered
 * if you want to serialize/cache the view result, you can not use Closure as content, you can use Spread Operator to merge with content array with condition like 
 * div([h1(),h2()]...(User::isGuest() ? [h3(),h4()] : []))
 * https://2ality.com/2017/04/conditional-literal-entries.html
 * 
 * or you can pass null if condition failed with emptytag for multiple elements
 * div([h1(),h2()...(User::isGuest() ? emptytag(h3(),h4()) : null))
 * 
 * or for single item
 * div([h1(),h2()...(User::isGuest() ? h3() : null))
 * ])
 */
function display(
    null|Tag|string|int|Closure|array $content,
    bool|Closure|null $renderCondition = true,
): Tag {
    return new Tag(
        tagname: false,
        renderCondition: $renderCondition,
        content: $content
    );
}

function italic(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'i',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function i(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'i',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function strong(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'strong',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function small(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'small',
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function p(
    array|Tag|string|Closure|null $content = null,
    ?string $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'p',
        content: $content,
        id: $id,
        class: $class,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function style(
    array|Tag|string|Closure|null $content = null,
    ?string $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    $tagname = 'style';

    return new Tag(
        tagname: $tagname,
        id: $id,
        class: $class,
        content: $content,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function source(
    string $type,
    ?string $src = null,
    ?string $srcset = null,
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($src) setAttr($attributes, 'src', $src);
    if ($srcset) setAttr($attributes, 'srcset', $srcset);

    setAttr($attributes, 'type', $type);


    return new Tag(
        tagname: 'source',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function figure(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'figure',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function label(
    array|Tag|string|Closure|null $content = null,
    ?string $for = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($for) setAttr($attributes, 'for', $for);

    return new Tag(
        tagname: 'label',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function form(
    array|Tag|string|Closure|null $content = null,
    ?string $method = 'get',
    ?string $action = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    if ($method) setAttr($attributes, 'method', $method);
    if ($action) setAttr($attributes, 'action', $action);

    return new Tag(
        tagname: 'form',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function figcaption(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'figcaption',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function table(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'table',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function header(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'header',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function thead(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'thead',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function tbody(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'tbody',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}

function tfoot(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'tfoot',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}



function tr(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'tr',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function th(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'th',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function td(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    ?int $colspan = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {

    if ($colspan) setAttr($attributes, 'colspan', $colspan);
    return new Tag(
        tagname: 'td',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}




function picture(
    array|Tag|string|Closure|null $content = null,
    string|null $id = null,
    array|string|null $class = null,
    ?array $attributes = null,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'picture',
        content: $content,
        class: $class,
        id: $id,
        attributes: $attributes,
        renderCondition: $renderCondition
    );
}


function title(
    string|Closure|null $title,
    bool|Closure|null $renderCondition = true
): Tag {
    return new Tag(
        tagname: 'title',
        content: $title,
        renderCondition: $renderCondition
    );
}
