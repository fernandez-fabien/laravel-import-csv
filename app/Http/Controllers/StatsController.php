<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Carbon;
use App\Models\ServiceType;

class StatsController extends Controller
{
    /**
     * Display a listing of statistics.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messageId = ServiceType::message()->id;
        $callId = ServiceType::call()->id;
        $dataId = ServiceType::connection()->id;

        $date = Carbon::create(2012, 2, 15);

        $totalConsumed = Service::selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(duration_consumed))) as sum_duration")
            ->where('service_type_id', $callId)
            ->where("made_at", ">", Carbon::create(2012, 2, 15))
            ->first();

        $volumesConsumedBySuscribers = Service::select("suscriber", "volume_billed")
            ->orWhereRaw("hour(made_at) < 8")
            ->orWhereRaw("hour(made_at) > 18")
            ->orderBy('volume_billed', 'DESC')
            ->limit(10)
            ->get()
            ->groupBy('suscriber');
            

        return view('stats.index', [
            'totalConsumed' => $totalConsumed->sum_duration,
            'totalMessages' => Service::where('service_type_id', $messageId)->count(),
            'volumesConsumedBySuscribers' => $volumesConsumedBySuscribers,
            'dateToCompare' => $date
        ]);
    }
}