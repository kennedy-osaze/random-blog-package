<?php

namespace Kennedy\RandomBlogPackage\Fields;

use Illuminate\Support\Carbon;

class Date extends FieldContract
{
    public static function process($type, $value, array $data = []): array
    {
        return [
            $type => Carbon::parse($value),
        ];
    }
}
