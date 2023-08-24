<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadImage')) {
    /**
     * Upload an image to the specified folder using a custom disk.
     *
     * @param string $folderName
     * @param UploadedFile $image
     * @return string|null
     */
    function uploadImage($folderName, UploadedFile $image)
    {
        try {
            $folder =  $folderName;

            // Generate a unique filename
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk($folderName)->putFileAs($folder, $image, $filename);

            return $filename;
        } catch (\Exception $e) {
            // Handle any exceptions, e.g., log or return an error message
            return null;
        }
    }
}
