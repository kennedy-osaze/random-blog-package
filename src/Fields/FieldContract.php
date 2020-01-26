<?php

namespace Kennedy\RandomBlogPackage\Fields;

abstract class FieldContract
{
    public static function process(
        string $fieldType, $fieldValue, array $data = []
    ): array {
        return [
            $fieldType => $fieldValue
        ];
    }
}
