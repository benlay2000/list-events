<?php

namespace App\UseCases;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MediaUsecase
{
    public function putMedium(string $currentPath, int $userId)
    {
        // とりあえずコントローラーに処理を書いておく
    }

    public function getFromMyFiles($userId)
    {
        $files = DB::table('media')->where('user_id', $userId)->get()->all();
        $fileInfoList = array_map(function ($file) {
            $fileInfo = $this->getFileInfo($file->path);
            $fileInfo['file_name'] = $file->original_name;
            $fileInfo['url'] = Storage::url($file->path);
            $fileInfo['id'] = $file->id;
            return $fileInfo;
        }, $files);
        return $fileInfoList;
    }

    public function getFileInfo($storagePath)
    {
        $fileInfo = [];
        $imageSize = getimagesize(Storage::path($storagePath));
        $fileInfo['url'] = Storage::url($storagePath);
        $fileInfo['file_type'] = pathinfo($storagePath, PATHINFO_EXTENSION);
        $fileInfo['width'] = $imageSize[0];
        $fileInfo['height'] = $imageSize[1];
        $fileInfo['file_size'] = Storage::size($storagePath);

        return $fileInfo;
    }
}
