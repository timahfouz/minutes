<?php

use App\Models\User;
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
    function resizeImage($file, $path, $dimensions = [100, 100], $allSizes=false) {

        $destination = public_path($path);

        if (!file_exists($destination)) {
            // mkdir($destination, 777, true);
            mkdir($destination);
        }

        $ext = strtolower($file->getClientOriginalExtension());
        $name = time().Str::random(5);
        $fileName = "$dimensions[0]X$dimensions[1]$name.$ext";

        
        $img = Image::make($file->getRealPath());

        $img->resize($dimensions[0], $dimensions[1], function ($constraint) {
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

if (!function_exists('getCarrier')) {
    function getCarrier() {
        return Auth::guard('carrier')->user();
    }
}



if (!function_exists('generateCode')) {
    function generateCode($digits=5) {
        $code = rand(pow(1, ($digits-1)), pow(10, $digits)-1);
        $exists = User::where('activation_code', $code)->first();
        if ($exists)
            generateCode();
        return $code;
    }
}


if (!function_exists('translateStatus')) {
    function translateStatus($status) {
        return [
            'pending'  => 'جارى التنفيذ',
            'on-way'  => 'قيد التوصيل',
            'completed'  => 'مكتمل',
            'rejected' => 'مرفوض'
        ][$status];
    }
}

if (!function_exists('sendSMS')) {
    function sendSMS($to, $message) {
        $url = "https://smsmisr.com/api/SMS/";

        $fields = "environment=1";
        $fields .= "&sender=b611afb996655a94c8e942a823f1421de42bf8335d24ba1f84c437b2ab11ca27";
        $fields .= "&username=66a17c01-4401-4f25-a0da-7465789671ad";
        $fields .= "&password=1a37f07cb8a1784f5cc7fbd244470371c072284937d447b197ae4248c076706c";
        $fields .= "&mobile=2$to";
        $fields .= "&language=2";
        $fields .= "&message=$message";
        

        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_URL, sprintf($url));
        curl_setopt($ch, CURLOPT_POST, 3);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        // execute post
        $result = curl_exec($ch);
        $result = json_decode($result);

        // close connection
        curl_close($ch);
        dd($result);
    }
}