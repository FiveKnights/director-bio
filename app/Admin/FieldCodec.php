<?php

namespace App\Admin;

/** Converts between what a form field holds and what the database stores. */
class FieldCodec
{
    /** Form input -> value stored in the database. */
    public static function fromForm(string $type, mixed $value): mixed
    {
        switch ($type) {
            case 'tags':
                return self::clean(explode(',', (string) $value));

            case 'lines':
                return self::clean(preg_split('/\R/', (string) $value) ?: []);

            case 'checkbox':
                return (bool) filter_var($value, FILTER_VALIDATE_BOOLEAN);

            case 'number':
                return ($value === null || $value === '') ? null : (int) $value;

            default:
                $value = trim((string) $value);

                return $value === '' ? null : $value;
        }
    }

    /** Stored value -> text shown inside a form field. */
    public static function forForm(string $type, mixed $value): mixed
    {
        if ($type === 'tags') {
            return is_array($value) ? implode(', ', $value) : (string) $value;
        }

        if ($type === 'lines') {
            return is_array($value) ? implode("\n", $value) : (string) $value;
        }

        return $value;
    }

    private static function clean(array $items): array
    {
        return array_values(array_filter(array_map('trim', $items), fn ($s) => $s !== ''));
    }
}