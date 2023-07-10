<?php

function setActive(array $route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

function checkDiscount($product): bool
{
    $currentDate = date('Y-m-d');
    return $product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date;
}

function calculateDiscountPercentage($originalPrice, $discountPrice): float|int
{
    $discountAmount = $originalPrice - $discountPrice;
    return ($discountAmount / $originalPrice) * 100;
}

function productType(string $type): string
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;
        case 'best_product':
            return 'Best';
            break;
        default:
            return '';
            break;
    }
}
