<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileUploaderHelper
{
    public static function upload(UploadedFile $file, string $path = 'public', string $disk = 'public'): string
    {
        $name = Str::random(40).'.'.$file->getClientOriginalExtension();
        $file->storeAs($path, $name, $disk);

        return $path.'/'.$name;
    }
}
