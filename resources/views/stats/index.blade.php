@extends('layouts.app')

@section('content')

    <h1>Stats on mobile usage</h1>

    <p><strong>Total duration of calls made after {{$dateToCompare->format('d/m/Y')}} :</strong> {{ $totalConsumed }}</p>
    
    <p><strong>Total of messages (sms/mms) :</strong> {{ $totalMessages }}</p>    

    <p><strong>Top 10 of volumes consummed before 8am or after 18pm by Suscribers : </strong></p>
    @foreach($volumesConsumedBySuscribers as $suscriberId => $datas)
        <p>N° {{$suscriberId}} : </p>
        <ul>
            @foreach($datas as $data)
                <li>
                    {{$data->volume_billed}}
                </li>                
            @endforeach
        </ul>
        
    @endforeach

@endsection