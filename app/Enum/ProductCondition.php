<?php

namespace App\Enum;

enum ProductCondition: string
{
    case OFFICIAL = 'official';
    case UNOFFICIAL = 'unofficial';
    case PREOWNED = 'pre-owned';

    public static function conditions(): array
    {
        return [
            self::OFFICIAL,
            self::UNOFFICIAL,
            self::PREOWNED,
        ];
    }

    public static function getCondition(string $condition): string
    {
        return match ($condition) {
            self::UNOFFICIAL->value => 'Unofficial',
            self::PREOWNED->value => 'Pre-owned',
            default => 'Official',
        };
    }
}
