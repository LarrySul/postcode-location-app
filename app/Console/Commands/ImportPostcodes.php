<?php

namespace App\Console\Commands;


use App\Traits\PostcodeUtils;
use Illuminate\Console\Command;
use App\Jobs\InitializePostcodeJob;


class ImportPostcodes extends Command
{
    use PostcodeUtils;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-and-create:postcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and import UK postcodes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $zipFileUrl = config('services.zip.file_url');
            $destinationPath = storage_path('app/public/postcode');
            $this->info('File processing ... Pls, wait');
            $create_file_directory = $this->downloadAndSavePostcodeFromRemoteServer($zipFileUrl, $destinationPath);
            InitializePostcodeJob::dispatch();
            $this->info('File completely processed ...');
        } catch (Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }

        return 0;
    }
}
