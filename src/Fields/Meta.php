<?php

namespace Kennedy\RandomBlogPackage\Fields;

class Meta extends FieldContract
{
    public static function process(
        string $type, $value, array $data = []
    ): array {
        $metaData = isset($data['meta']) ? (array) $data['meta'] : [];

        return [
            'meta' => array_merge($metaData, [$type => trim($value)]),
        ];
    }
}