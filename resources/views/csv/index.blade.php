@extends('layouts.app')

@section('content')

<h1>Import mobile data</h1>

@include('csv.form')

<table class="table">
  <thead>
    <tr>
      <th>Filename</th>
      <th>Processed ?</th>
    </tr>
  </thead>

  <tbody>
    @foreach($csv as $file)
      <tr>
        <th>{{ $file->filename}}</th>
        <th>@lang('csv.processed.' . $file->processed)</th>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $csv->links() }}

@endsection