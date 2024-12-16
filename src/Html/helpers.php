<?php

namespace Metal\Html;

use Metal\Base\Tag;

function setAttrs(array|null &$attributes, array $newattributes, $merge = false, $mergeSeparator = ';')
{

    foreach ($newattributes as $key => $value) {
        setAttr($attributes, $key, $value, merge: $merge, mergeSeparator: $mergeSeparator);
    }

    return $attributes;
}

function setAttr(array|null &$attributes, $key, $value, $merge = false, $mergeSeparator = ';')
{
    if (!$merge) {
        $attributes[$key] = $value;
    } else {
        if (isset($attributes[$key]) && $attributes[$key]) {
            $attributes[$key] .= $mergeSeparator .  $value;
        } else {
            $attributes[$key] = $value;
        }
    }

    return $attributes;
}

function setStyle(array|null &$attributes, string $style)
{
    setAttr($attributes, 'style', $style, merge: true, mergeSeparator: ';');
}

function is_tag($tag)
{
    return is_a($tag, 'metal\html\base\Tag');
}


/** static variable counter is cleaner
 * but I tried to use random value, because using opcache with php 8 caused some problems, the id is not unique per request for some reason
 */
function makeId(bool $random = true)
{
    static $idCounter = 0;
    $idCounter++;

    if ($random) {
        $idCounter += mt_rand(111, 9999);
    }

    return "id_metal_{$idCounter}";
}

function hasClass(string|array $class, $classname)
{
    $class = is_array($class) ? $class : explode(' ', $class);

    $result = array_filter($class, function ($cls) use ($classname) {
        $cls = trim($cls);
        if (str_contains($cls, ' ')) {
            $cls = explode(' ', $cls);
            foreach ($cls as $c) {
                if (trim($c) == $classname) {
                    return true;
                }
            }
        } else {
            if (trim($cls) == $classname) return true;
        }
    });

    return count($result)  > 0;
}

function initContent(int|array|string|Tag|null &$content)
{
    if ($content === null || $content === '') $content = [];
    if (!is_array($content)) $content = [$content];
}
function initClass(array|string|null &$class)
{
    if ($class === null || $class === '') $class = [];
    if (!is_array($class)) $class = [$class];
}

function addClass(string|array|null &$class, string|array $newClassName)
{
    if (is_array($class)) {
        $aryClass = null;

        if (is_array($newClassName)) {
            $aryClass = $newClassName;
        } else {
            $aryClass = explode(' ', $newClassName);
        }

        $class = array_merge($class, $aryClass);
    } else {
        $strClass = null;
        if (is_array($newClassName)) {
            $strClass = implode(' ', $newClassName);
        } else {
            $strClass = $newClassName;
        }
        $class .= " {$strClass}";
    }

    return $class;
}
