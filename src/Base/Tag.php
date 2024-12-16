<?php

namespace Metal\Base;

use Closure;

use function Metal\Html\addClass;
use function Metal\Html\is_tag;
use function Metal\Html\setAttr;

class Tag
{

    /**
     * @var $tagname The element tagname (like div, p)
     * @var $content The element content, it can be string, or another Tag, or array of string or array of Tags, also content can be Closure that returns the value
     * @var $id HTML element id
     * @var $class HTML element class, string or array
     * @var $attributes array of key=>value html element attributes
     * @var $renderElement
     */
    public function __construct(
        public string $tagname,
        public array|Tag|string|Closure|null $content = null,
        public string|null $id = null,
        public string|array|null $class = null,
        public ?array $attributes = null,
        public bool|Closure|null $renderCondition = true,
        public bool $selfClosing = false,

    ) {}


    public function __toString()
    {
        return $this->render();
    }

    public function render(): ?string
    {
        $renderCondition = $this->renderCondition;
        if ($renderCondition instanceof Closure) {
            if (!$renderCondition()) {
                return null;
            }
        } else {
            if (!$renderCondition) {
                return null;
            }
        }

        $output = null;

        $attributes = $this->attributes;

        $class = $attributes['class'] ?? '';

        if ($this->class) {
            addClass($class, $this->class);
        }


        if (is_array($class)) {
            $class = implode(' ', $class);
        }

        if ($class) {
            setAttr($attributes, 'class', trim($class));
        }

        if ($this->id) {
            setAttr($attributes, 'id', $this->id);
        }


        if ($this->tagname) {
            $output .= "<$this->tagname";

            if ($attributes && count($attributes)) {
                foreach ($attributes as $key => $val) {
                    if (is_int($key)) {
                        $output .= " $val";
                    } else {
                        $output .= " $key";
                        $strval = null;

                        if ($val === true) {
                            $strval = 'true';
                        } elseif ($val === false) {
                            $strval = 'false';
                        } else {
                            $strval = $val;
                        }

                        if ($strval !== null) {
                            $output .= "=\"$strval\"";
                        }
                    }
                }
            }
            $output .= '>';
        }

        $content = $this->content;

        if ($content instanceof Closure) {
            $content = $content();
        }

        if (!is_array($content)) {
            if ($content !== null && $content !== '') {
                $content = [$content];
            } else {
                $content = [];
            }
        }


        foreach ($content as $child) {
            if ($child === null || $child === '')
                continue;

            if (is_tag($child)) {
                $r = $child->render();
                if ($r !== null) {
                    $output .= $r;
                }
            } else {
                if (is_array($child)) {
                    foreach ($child as $ch) {
                        if (is_tag($ch)) {
                            $r = $ch->render();
                            if ($r !== null) {
                                $output .= $r;
                            }
                        } else {
                            $output .= $ch;
                        }
                    }
                } else {
                    $output .= (string) $child;
                }
            }
        }


        if ($this->tagname) {
            if (!$this->selfClosing) {
                $output .= "</$this->tagname>";
            }
        }

        return $output ?? '';
    }
}
