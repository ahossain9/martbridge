<?php

namespace App\Enum;

enum LabelColor: string
{
    case TOP = 'top';
    case NEW = 'new';
    case HOT = 'hot';
    case SALE = 'sale';
    case BEST_SELLER = 'best_seller';
    case FEATURED = 'featured';
    case TRENDING = 'trending';
    case OFFER = 'offer';
    case USED = 'used';
    case OUT = 'out';
    case FREE_SHIPPING = 'free_shipping';
    case FREE_DELIVERY = 'free_delivery';

    public static function labels()
    {
        return [
            self::TOP,
            self::NEW,
            self::HOT,
            self::SALE,
            self::OUT,
            self::BEST_SELLER,
            self::FEATURED,
            self::TRENDING,
            self::OFFER,
            self::USED,
            self::FREE_SHIPPING,
            self::FREE_DELIVERY,
        ];
    }

    public static function labelColor(string $label): string
    {
        return match ($label) {
            self::TOP->value => 'label-top',
            self::NEW->value => 'label-new',
            self::SALE->value => 'label-sale',
            self::OUT->value => 'label-out',
            self::HOT->value => 'bg-danger text-white',
            self::BEST_SELLER->value => 'bg-success',
            self::TRENDING->value => 'bg-secondary',
            default => 'bg-gradient-dark',
        };
    }
}
