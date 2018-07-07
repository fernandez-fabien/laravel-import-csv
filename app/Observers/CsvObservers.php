<?php

namespace App\Observers;

use App\Jobs\ProcessCsv;
use App\Models\Csv;

class CsvObserver
{
    /**
     * Handle to the csv "created" event.
     *
     * @param  \App\Models\Csv  $csv
     * @return void
     */
    public function created(Csv $csv)
    {
        ProcessCsv::dispatch($csv);
    }
}