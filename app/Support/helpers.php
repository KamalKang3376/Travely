<?php

if (!function_exists('travely_image_url')) {
    function travely_image_url(?string $image): ?string
    {
        if (!$image) {
            return null;
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        return asset('storage/' . $image);
    }
}