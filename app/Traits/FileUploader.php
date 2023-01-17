<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait FileUploader
{

    public static function uploadImageFormData($imageObject, $folder = null, $model = null, $type = null, $disk = 'public')
    {
        $fileName = time() . rand(0, 10000) . '.' . $imageObject->getClientOriginalExtension();
        $destination = $folder . '/' . $fileName;
        Storage::disk($disk)->put($destination, $imageObject);
        $path = $disk . '/' . $destination;
        return static::saveImageModel($path, $model, $type);
    }

    public static function uploadImageBase64($imageObject, $folder = null, $model = null, $type = null, $disk = 'public')
    {
        $image_base64 = $imageObject['src'];

        $imageValue = preg_replace('/^data:image\/\w+;base64,/', '', $image_base64);
        $extension = explode('/', mime_content_type($image_base64))[1];
        $src = base64_decode($imageValue);
        $fileName = time() . rand(0, 10000) . '.' . $extension;
        $destination = $folder . '/' . $fileName;
        Storage::disk($disk)->put($destination, $src);
        $path = $disk . '/' . $destination;
        return static::saveImageModel($path, $model, $type);
    }

    public static function saveImageModel($path, $model, $type)
    {
        $data = [
            'url' => $path,
            'type' => $type
        ];
        if ($model) {
            $image = $model->images()->create($data);
        } else {
            $image = Image::create($data);
        }

        return $image;
    }

    public static function updateImageModel(Image $oldImage, $alt_en, $alt_ar)
    {
        $oldImage->update([
            'alt_en' => $alt_en,
            'alt_ar' => $alt_ar
        ]);
        return $oldImage;
    }

    public static function uploadSheet($rawSheet, $folder = 'sheets')
    {
        $base64Sheet = base64_decode($rawSheet);
        $fileName = time() . '.xlsx';
        $path = "$folder/" . $fileName;
        Storage::disk('public')->put($path, $base64Sheet);
        return 'public/' . $path;
    }
}