<?php

use App\Http\Controllers\MediumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(env('APP_DOMAIN'))->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/layouts', function () {
            return Inertia::render('Layouts');
        })->name('layouts');

        Route::get('/settings', function () {
            return Inertia::render('Settings');
        })->name('settings');
        Route::post('/settings', [WebsiteController::class, 'storeSettings'])->name('settings');

        Route::get('/media-manager', function () {
            return Inertia::render('Media');
        })->name('media-manager');

        Route::get('/php', function () {
            $postMaxSize = ini_get('post_max_size');
            $uploadMaxFilesize = ini_get('upload_max_filesize');

            return [
                'postMaxSize' => $postMaxSize,
                'uploadMaxFilesize' => $uploadMaxFilesize,
            ];
        })->name('php-settings');

        Route::get('/media', [MediumController::class, 'get'])->name('media');
        Route::post('/media', [MediumController::class, 'store'])->name('media');
        Route::delete('/media', [MediumController::class, 'delete'])->name('media');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/preview', [WebsiteController::class, 'preview'])->middleware(['auth', 'verified'])->name('preview');
});

if (Schema::hasTable('domain')) {
    $domains = DB::table('domains')->join('pages', 'domains.id', '=', 'pages.domain_id')->get()->all();

    // ドメインルーティング
    foreach ($domains as $domain) {
        Route::domain($domain->domain)->group(function () use ($domain) {
            Route::view($domain->url, 'public-page', [
                'settings' => $domain->settings,
                'content' => $domain->content,
            ]);
        });
    }
}

require __DIR__ . '/auth.php';
