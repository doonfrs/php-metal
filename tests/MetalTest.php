<?php

use function Metal\Html\a;
use function Metal\Html\div;
use function Metal\Html\head;
use function Metal\Html\hr;
use function Metal\Html\htmlPage;
use function Metal\Html\span;

use Metal\Metal;
use PHPUnit\Framework\TestCase;

class MetalTest extends TestCase
{
    public function testRenderSimpleHtml()
    {

        $html = Metal::render(htmlPage(
            head: head(title: 'test'),
            body: div('Test')
        ));

        $this->assertEquals(
            '<!DOCTYPE html><html><head><title>test</title></head><div>Test</div></html>',
            $html
        );
    }

    public function testRenderHtmlChain()
    {

        $html = Metal::render(htmlPage(
            head: head(title: 'test'),
            body: div(
                [
                    a(href: '#', content: span('Hey!')),
                    hr(),
                    div('After link'),
                ]
            )
        ));

        $this->assertEquals(
            '<!DOCTYPE html><html><head><title>test</title></head><div><a href="#"><span>Hey!</span></a><hr><div>After link</div></div></html>',
            $html
        );
    }
}
