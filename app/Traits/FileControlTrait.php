<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileControlTrait
{

    public function uploadFile(UploadedFile $file, string $directory, string $disk = 'public'): ?string
    {
        if ($file) {
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs($directory, $filename, $disk);
            return $filePath;
        }

        return null;
    }

    public function deleteFile(?string $filePath, string $disk = 'public'): bool
    {
        if ($filePath && Storage::disk($disk)->exists($filePath)) {
            return Storage::disk($disk)->delete($filePath);
        }

        return false;
    }
}
