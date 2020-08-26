<?php

namespace Tests\Feature\devices;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class DeviceTest extends TestCase
{
    public function test_guests_cannot_import_csv()
    {
        $this->get('/devices')
            ->assertStatus(302)
            ->assertLocation('/login');
    }

    public function test_import_csv()
    {
        // If your route requires authenticated user
        $user = Factory('App\User')->create();
        $this->actingAs($user);


         $fileName = 'device.csv';
        $filePath = __DIR__ ;


        $filePathWithName = __DIR__ . '/'.$fileName;





        $this->postJson('/import_process', [
            'file' => new UploadedFile($filePathWithName, $fileName, $mimeType = null, $size = null, $error = 0, $testMode = true),
        ])->assertStatus(200);
    }
}
