<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileManageHelper
{
    public static function upload(UploadedFile $file, string $path = 'public', string $disk = 's3'): string
    {
        return Storage::disk($disk)->put($path, $file);
    }

    // make a function that will delete the file from the s3 bucket
    public static function delete(string $path = '', string $disk = 's3'): string
    {
        if (empty($path)) {
            return '';
        }

        return Storage::disk($disk)->delete($path);
    }

    public static function getS3FileUrl($path): string
    {
        if (empty($path)) {
            return '#';
        }

        return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(2));
    }

    public static function getS3FileUrlWithExpiry($path, $expiry): string
    {
        if (empty($path)) {
            return '#';
        }

        return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes($expiry));
    }

    public static function duplicate(string $oldPath, string $newPath, string $disk = 's3')
    {
        Storage::disk($disk)->copy($oldPath, $newPath);

        return $newPath;
    }
}
