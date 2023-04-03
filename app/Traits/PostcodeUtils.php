<?php

namespace App\Traits;

use ZipArchive;
use Illuminate\Support\Facades\Storage;


trait PostcodeUtils
{

    public function downloadAndSavePostcodeFromRemoteServer(string $zipFileUrl, string $destinationPath) : string 
    {
        try {
            $tempFilePath = Storage::path('public/'.uniqid('zip_', true));
            file_put_contents($tempFilePath, file_get_contents($zipFileUrl));
            $zip = new ZipArchive;
            if($zip->open($tempFilePath, ZipArchive::CREATE) === true){
                $zip->extractTo($destinationPath );
                $zip->close();
                unlink($tempFilePath);
                return $destinationPath;
            }
        }catch(Exception $e){
            info('Unable to create file ' . $e->getMessage());
        }
    }

    public function calculateBoundingBox(float $latitude, float $longitude, int $distanceInMiles) : array
    {
        $earthRadius = 3959; // Radius of the earth in miles
        
        $latRadians = deg2rad($latitude); // deg2rad opposite rad2deg
        $lonRadians = deg2rad($longitude);
        
        $distanceRadians = $distanceInMiles / $earthRadius;
        // Calculate the minimum and maximum latitude and longitude values for the bounding box
        $minLat = rad2deg($latRadians - $distanceRadians); //rad2deg converts a radian value to a degree value
        $maxLat = rad2deg($latRadians + $distanceRadians);
        $minLong = rad2deg($lonRadians - $distanceRadians / cos($latRadians));
        $maxLong = rad2deg($lonRadians + $distanceRadians / cos($latRadians));
        
        return [
            'min_lat' => round($minLat, 8),
            'max_lat' => round($maxLat, 8),
            'min_long' => round($minLong, 8),
            'max_long' => round($maxLong, 8),
        ];
    }
}