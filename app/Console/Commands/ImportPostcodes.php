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
    protected $signature = 'import:postcodes';

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
            $create_file_directory = $this->downloadAndSavePostcodeFromRemoteServer();
            $this->info('Job has been processed ...');
            InitializePostcodeJob::dispatch();
            $this->info('Job executed completely ...');
        } catch (Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }

        return 0;
    }
}
