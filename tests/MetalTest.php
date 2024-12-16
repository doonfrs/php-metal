<?php

use function Metal\Html\div;
use function Metal\Html\head;
use function Metal\Html\htmlPage;

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
}
