<?php

namespace Tests\Unit;

use App\Models\User;
use App\UseCases\MediaUsecase;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class MediaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_from_elvyta(): void
    {
        $media = new MediaUsecase();
        $files = Storage::files('public/media/elvyta');
        $fileInfoList = array_map(function ($file) use ($media) {
            return $media->getFileInfo($file);
        }, $files);
        var_dump($fileInfoList);
        $this->assertEquals('array', type($fileInfoList));
    }

    public function test_manage_my_files()
    {
        $user = User::factory()->create();
        $fakeFile = HttpUploadedFile::fake()->image('elvyta_test_1234.jpg');
        $responseOfUpload = $this->actingAs($user)->post(route('media'), [
            'file' => $fakeFile,
        ])->assertOk();

        $fakeMime = $fakeFile->getClientMimeType();
        $uploadedFileMime = Storage::mimeType($responseOfUpload['file_path']);
        $this->assertEquals($fakeMime, $uploadedFileMime);
        $this->delete(route('media'), [
            'id' => $responseOfUpload['id'],
        ])->assertOk();
    }
}
