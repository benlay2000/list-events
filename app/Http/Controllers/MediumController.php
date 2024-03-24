<?php

namespace App\Http\Controllers;

use App\UseCases\MediaUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediumController extends Controller
{

    function get(Request $request)
    {
        $mediaKey = $request->mediaKey;
        $mediaUsecase = new MediaUsecase();
        $user = Auth::user();
        $media = match ($mediaKey) {
            default => $mediaUsecase->getFromMyFiles($user->id),
            'elvyta' => Storage::files("public/media/elvyta"),
        };

        return response()->json($media);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('file');

        if (!$file->isValid()) {
            return response('invalid file', 400);
        }
        $originalName = $file->getClientOriginalName();
        $subDirectory = rand(10, 99);
        $path = $file->store("public/media/userfile/{$subDirectory}");

        DB::table('media')->insert([
            'user_id' => $user->id,
            'path' => $path,
            'original_name' => $originalName,
        ]);
        $id = DB::getPdo()->lastInsertId();
        return response(['status' => 'success', 'file_path' => $path, 'id' => $id], 200);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $deleteItem = DB::table('media')->where('user_id', $user->id)->where('id', $request->id)->get()->first();
        Storage::delete($deleteItem->path);
        DB::table('media')->where('user_id', $user->id)->where('id', $request->id)->delete();
    }
}
