<?php

namespace Kennedy\RandomBlogPackage\Tests\Unit;

use Kennedy\RandomBlogPackage\Tests\TestCase;
use Kennedy\RandomBlogPackage\MarkdownParser;

class MarkdownTest extends TestCase
{
    public function testBasicMarkdownParsing()
    {
        $this->assertEquals('<h1>Hello world</h1>', MarkdownParser::parse('# Hello world'));
    }
}