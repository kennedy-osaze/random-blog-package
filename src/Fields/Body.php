<?php

namespace Kennedy\RandomBlogPackage\Fields;

use Kennedy\RandomBlogPackage\MarkdownParser;

class Body extends FieldContract
{
    public static function process($type, $value, array $data = []): array
    {
        return [
            $type => MarkdownParser::parse($value),
        ];
    }
}
