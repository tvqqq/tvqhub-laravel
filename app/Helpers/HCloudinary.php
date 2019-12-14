<?php

namespace App\Helpers;

use Cloudinary as CloudinaryLib;
use Cloudinary\Uploader;

class HCloudinary
{
    protected CloudinaryLib $cloudinary;
    protected Uploader $uploader;

    public function __construct(CloudinaryLib $cloudinary, Uploader $uploader)
    {
        $this->cloudinary = $cloudinary;
        $this->uploader = $uploader;

        $this->cloudinary->config([
            'cloud_name' => config('cloudinary.cloud_name'),
            'api_key' => config('cloudinary.api_key'),
            'api_secret' => config('cloudinary.api_secret'),
            'secure' => true
        ]);
    }

    public function upload($filePath, $folder = null)
    {
        return $this->uploader->upload($filePath, [
            'folder' => (config('app.env') === 'local' ? '_local/' : null) . $folder
        ]);
    }
}
