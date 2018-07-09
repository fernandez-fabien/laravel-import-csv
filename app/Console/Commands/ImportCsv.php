<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Csv;

class ImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:dataMobileCsv {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Specify the path to the data mobile csv to import (in storage/app/)';

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
     * @return mixed
     */
    public function handle()
    {
        $filepath = $this->argument('path');

        $filename = explode('/', $filepath);
        $filename = end($filename);

        Csv::create([
            "filename" => $filename,
            "filepath" => $filepath,
            "extension" => 'csv'
        ]);
    }
}
