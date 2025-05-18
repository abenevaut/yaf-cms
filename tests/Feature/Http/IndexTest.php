<?php

namespace Tests\Feature\Http;

use Tests\TestCase;
use Yaf\Request\Simple;

class IndexTest extends TestCase
{
    public function testToDisplayIndex()
    {
        $this->get('/');

        $this->assertSame('Hello World', $this->getView()->content);
    }
}
