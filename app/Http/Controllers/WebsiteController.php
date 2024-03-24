<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class WebsiteController extends Controller
{
    public function storeSettings(Request $request)
    {
        $request->validate([
            'domain' => 'string',
            'favicon' => 'file',
            'logo' => 'file',
            'title' => 'required|string',
            'description' => 'string',
            'ogp' => 'file',
            'copyright' => 'string',
        ]);

        $post = $request->all();
        $user = Auth::user();
        $files = $request->file();

        foreach ($files as $key => $file) {
            $now = microtime(true);
            $hash = hash('sha256', $now . $user->id);
            $fileName = "{$hash}.{$file->getClientOriginalExtension()}";
            $file->storeAs('public', "media/{$fileName}");
            $post[$key] = $fileName;
        }

        $domain = $post['domain'];
        unset($post['domain']);
        unset($post['_token']);
        Domain::updateOrCreate(
            ['user_id' => $user->id, 'domain' => $domain, 'settings' => json_encode($post)],
        );
    }

    public function preview(Request $request)
    {
        // JSONを受け取って配列化し、Viewにわたす
        $settings = json_decode($request->settings, true);
        return view('website.preview', ['settings' => $settings]);
    }
}
