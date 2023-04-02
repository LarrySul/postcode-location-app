<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use App\Jobs\CompletePostcodeJob;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class InitializePostcodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct()
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $file = Storage::path("public/postcode".config('services.zip.file_name'));
            $handle = fopen($file, 'r');
            $header = fgetcsv($handle); // read the header row
            while (($data = fgetcsv($handle)) !== false) {
                $row = array_combine($header, $data); // combine the header with the row data
                CompletePostcodeJob::dispatch($row);
            }
            fclose($handle);
            return;
        }catch(Exception $e){
            info("error occured ". $e->getMessage());
        }
    }
}
