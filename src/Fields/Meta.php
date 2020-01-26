<?php

namespace Kennedy\RandomBlogPackage\Fields;

class Meta extends FieldContract
{
    public static function process(
        string $type, $value, array $data = []
    ): array {
        $metaData = isset($data['meta'])
            ? json_decode($data['meta'], true)
            : [];

        return [
            'meta' => json_encode(array_merge(
                $metaData,
                [$type => trim($value)]
            )),
        ];
    }
}