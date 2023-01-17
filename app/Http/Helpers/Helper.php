<?php

/**
 * @param \Illuminate\Http\UploadedFile $photo
 * @param $path
 * @return string
 */
function UplaodPhoto($photo, $path)
{
    $image = $photo;
    $imageName = time() . $image->getClientOriginalName();
    $photo->move(public_path('uploads/' . $path), $imageName);
    $photo = 'uploads/' . $path . '/' . $imageName;
    return $photo;
}


function createSerial($model_id = 0, $last_serial = "1-00000-1", $user_id = 0, $code = '00000')
{

    if ($last_serial == null) {
        $last_serial = "1-00000-1";
    }
    $parts = explode("-", $last_serial);
    $serial = $parts[1];
    $serial++;

    $nextReference = $model_id . "-"  . $code . $serial . "-" . $user_id;

    return $nextReference;
}