{!! Form::open(['route' => 'csv.store', 'files' => true, 'class' => 'my-4']) !!}

  <div class="form-group">

    {!! Form::label('file', __('csv.attributes.file')) !!}
    {!! Form::file("file", ["class" => "form-control"]) !!}
  </div>

  {!! Form::submit(__('forms.submit'), ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}