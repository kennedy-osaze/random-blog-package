<?php

namespace Kennedy\RandomBlogPackage;

use Parsedown;

class MarkdownParser
{
    public static function parse(string $text)
    {
        return Parsedown::instance()->text($text);
    }
}
