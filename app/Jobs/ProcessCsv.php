<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Csv;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Storage;
use Excel;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $csv;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Csv $csv)
    {
        $this->csv = $csv;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $csv = $this->csv;
        Excel::filter('chunk')->load(storage_path("app/files/tickets_appels_201202.csv"))->chunk(200, function($reader) use ($csv) {
            $reader->each(function($row) use ($csv) {
                $durationConsumed = DateTime::createFromFormat("H:i:s", $row['_3']) ?: null;
                $durationBilled = DateTime::createFromFormat("H:i:s", $row['_4']) ?: null;

                $user = User::firstOrCreate(["id" => intval($row['_2'])]);

                if (strpos($row['type'], 'appel') !== false) {
                    $serviceType = ServiceType::where('title', ServiceType::SERVICE_TYPE_CALL)->first()->id;
                } elseif (strpos($row['type'], 'connexion') !== false) {
                    $serviceType = ServiceType::where('title', ServiceType::SERVICE_TYPE_CONNECTION)->first()->id;
                } else {
                    $serviceType = ServiceType::where('title', ServiceType::SERVICE_TYPE_MESSAGE)->first()->id;
                }

                Service::firstOrCreate([
                    "made_at" => Carbon::createFromFormat("d/m/Y H:i:s", $row['date'] . ' ' . $row['heure'])->toDateTimeString(),
                    "duration_consumed" => $durationConsumed,
                    "duration_billed" => $durationBilled,
                    "volume_consumed" => $durationConsumed ? null : $row['_3'],
                    "volume_billed" => $durationBilled ? null : $row['_4'],
                    "service_type_id" => $serviceType,
                    "suscriber" => intval($row['_2'])
                ]);
            });
        });
        $this->csv->update(["processed" => true]);
    }
}