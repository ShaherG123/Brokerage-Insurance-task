<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function apiResponse($message = null, $meta = null, $items = null, $error = null, $code = 200)
    {
        $array = [
            'meta' => $meta,
            'items' => $items,
            'status' => in_array($code, $this->successCode()) ? true : false,
            'message' => $message,
            'errors' => $error,
        ];
        return response($array, $code);
    }

    protected function successCode()
    {
        return [
            200, 201, 202,
        ];
    }

    protected function storeFile($disk, $file)
    {
        $extension = $file->getClientOriginalExtension(); // getting image extension
        // $fileName = uniqid() . '.' . $extension; // renameing image
        $fileName = Storage::disk($disk)->put('', $file);
        return $fileName;
    }

    protected function deleteFile($disk, $file)
    {
        $extension = $file->getClientOriginalExtension(); // getting image extension
        // $fileName = uniqid() . '.' . $extension; // renameing image
        $fileName = Storage::disk($disk)->delete('', $file);
        return $fileName;
    }

    protected function Message($message, $id = 0, $triger = [], $date = [], $metaData = [], $statusCode = 200)
    {
        $responseData = array('Message' => $message, 'id' => $id, 'triggers' => $triger, 'data' => $date, 'metaData' => $metaData);
        return response($responseData, $statusCode);
    }
}
