<?php

namespace Feature\Http;

use Tests\TestCase;
use Yaf\Request\Simple;

class IndexTest extends TestCase
{
    public function testToDisplayIndex()
    {
        $response = $this->get('/');

        $this->assertSame('Hello World', $this->getView()->content);

        var_dump($response);
    }
}
