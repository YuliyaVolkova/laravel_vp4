<?php

namespace App\Services;

use Intervention\Image\ImageManagerStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageToUpload
{
    public function checkImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }
        // проверка на размер изображения
        if (!getimagesize($request->file('image')->path())) {
            return null;
        }
        // сохраняем изображение в storage/app/public/image
        $imageUrl = $request->file('image')->store('public/images');

        // путь к изображению для resize imageIntervention
        $imgUrl = PUBLIC_PATH . DIRECTORY_SEPARATOR . '../storage/app/' . $imageUrl;

        if (!$this->uploadedImageHandler($imgUrl)) {
            Storage::delete($imageUrl);
            return null;
        }

        return str_replace('public', 'storage', $imageUrl);
    }

    protected function uploadedImageHandler($filePath)
    {

        $img = ImageManagerStatic::make($filePath);
        $img->resize(350, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($filePath);
        if (file_exists($filePath)) {
            return true;
        }
        return false;
    }
}
