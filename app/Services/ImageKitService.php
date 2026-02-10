<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );
    }

   public function upload($file, $folder = '/uploads/')
{
    $response = $this->imageKit->upload([
        'file' => $file, // base64 file
        'fileName' => time() . '.jpg',
        'folder' => $folder,
    ]);

    if (isset($response->error)) {
        throw new \Exception($response->error->message);
    }

    return $response->result->url;
}

}
