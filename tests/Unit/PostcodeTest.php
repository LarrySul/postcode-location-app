<?php

use Tests\TestCase;
use App\Traits\PostcodeUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PostcodeUtilsTest extends TestCase
{
    use RefreshDatabase, PostcodeUtils;
    public function test_download_and_save_postcode_from_remote_server()
    {
        $expectedCsvFilePath = Storage::path("public/postcode");
        $actualCsvFilePath = $this->downloadAndSavePostcodeFromRemoteServer();
        $this->assertEquals(Storage::path("public/postcode"), $actualCsvFilePath);
        $this->assertFileExists(Storage::path("public/postcode".config('services.zip.file_name')));
        Storage::delete("public/postcode");
    }

    public function test_calculate_bounding_box()
    {
        $latitude = 40.7128;
        $longitude = -74.0060;
        $distanceInMiles = 10;

        $expectedBoundingBox = [
            'min_lat' => 40.56807714,
            'max_lat' => 40.85752286,
            'min_long' => -74.19693012,
            'max_long' => -73.81506988
        ];

        $actualBoundingBox = $this->calculateBoundingBox($latitude, $longitude, $distanceInMiles);
        $this->assertEquals($expectedBoundingBox, $actualBoundingBox);
    }
}
