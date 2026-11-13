<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CloudinaryImageService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(
            config('services.cloudinary.url')
        );
    }

    public function upload(UploadedFile $file, string $folder): string
    {
        $result = $this->cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'travely/' . $folder,
                'resource_type' => 'image',
            ]
        );

        return $result['secure_url'];
    }

    public function delete(?string $image): void
    {
        if (!$image) {
            return;
        }

        if (str_contains($image, 'res.cloudinary.com')) {
            $path = parse_url($image, PHP_URL_PATH);

            if (!$path) {
                return;
            }

            $parts = explode('/upload/', $path, 2);

            if (count($parts) !== 2) {
                return;
            }

            $publicId = preg_replace(
                '/^v\d+\//',
                '',
                $parts[1]
            );

            $publicId = preg_replace(
                '/\.[^.]+$/',
                '',
                $publicId
            );

            $this->cloudinary->uploadApi()->destroy($publicId);

            return;
        }

        Storage::disk('public')->delete($image);
    }
}
