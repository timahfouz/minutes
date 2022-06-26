<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if (!function_exists('jsonResponse')) {
    function jsonResponse($code = 200, $message = 'done', $data = []) {
        $code = getCode($code);
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}


if (!function_exists('getCode')) {
    function getCode($code) {
        return ($code >= 100 && $code < 600) ? $code : 500;
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($file, $path, $edit = false, $oldFile = null) {
        $destination = public_path().'/'.$path;
        $oldDestination = public_path().'/'.$path.'/'.$oldFile;
        if($edit && is_file($oldDestination)) {
            $name = explode('.', $oldFile)[0];
            if($name != 'default')
                unlink($oldDestination);
        }
        $ext = $file->getClientOriginalExtension();
        $name = time().Str::random(5);
        $fileName = $name.'.'.$ext;
        $file->move($destination, $fileName);
        return $fileName;
    }
}


if (!function_exists('resizeImage')) {
    function resizeImage($file, $path, $allSizes=false) {

        $destination = public_path($path);

        if (!file_exists($destination)) {
            // mkdir($destination, 777, true);
            mkdir($destination);
        }

        $ext = strtolower($file->getClientOriginalExtension());
        $name = time().Str::random(5);
        $fileName = '165X165'.$name.'.'.$ext;

        
        $img = Image::make($file->getRealPath());

        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destination.'/'.$fileName);

        return "$path/$fileName";
    }
}


if (!function_exists('imagesSizes')) {
    function imagesSizes() {
        return [
            [110, 110],
            [165, 165],
            [180, 180],
            [200, 200],
            [300, 300],
        ];
    }
}




if (!function_exists('getFullImagePath')) {
    function getFullImagePath($model) {
        return $model->image_id ? $model->image->realPath() : null;
    }
}


if (!function_exists('getUser')) {
    function getUser() {
        return Auth::guard('api')->user();
    }
}