<?php

namespace App\Http\Controllers\DataClear;

use Intervention\Image\ImageManagerStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait imageTrait
{
    protected $data;

    protected function checkImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }
        // проверка на размер изображения
        if (!getimagesize($request->file('image')->path())) {
            return null;
        }
        // сохраняем изображение в storage/app/public/image
        $this->data['image_url'] = $request->file('image')->store('public/images');

        // путь к изображению для resize imageIntervention
        $imgUrl = PUBLIC_PATH . DIRECTORY_SEPARATOR . '../storage/app/' . $this->data['image_url'];

        if (!$this->uploadedImageHandler($imgUrl)) {
            Storage::delete($this->data['image_url']);
            return $this->data['image_url'] = null;
        }

        return $this->data['image_url'] = str_replace('public', 'storage', $this->data['image_url']);
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
