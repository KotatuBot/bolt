<?php

namespace Bolt\Tests\Response;

use Bolt\Collection\ImmutableBag;
use Bolt\Response\TemplateResponse;
use Bolt\Tests\BoltUnitTest;

/**
 * TemplateResponse test.
 *
 * @author Gawain Lynch <gawain.lynch@gmail.com>
 */
class TemplateResponseTest extends BoltUnitTest
{
    public function testCreate()
    {
        $twig = new \Twig_Environment(new \Twig_Loader_Array(['error.twig' => '']));
        $template = $twig->resolveTemplate('error.twig');

        $context = ['foo' => 'bar'];
        $response = new TemplateResponse($template, $context);

        $this->assertInstanceOf(TemplateResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error.twig', $response->getTemplate());
        $this->assertInstanceOf(ImmutableBag::class, $response->getContext());
        $this->assertEquals($context, $response->getContext()->toArray());
    }
}
