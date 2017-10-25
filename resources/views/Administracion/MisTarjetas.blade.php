@extends('layouts.app')

@section('content')
    <link href="css/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif
<font color="white">
<div class="container">
    <div class="row">
      <ul class="nav nav-pills">
        @foreach($abecedario as $abc)
          @if($abc == 'A')
            <li class="active"><a data-toggle="pill" href="#{{ $abc }}">{{ $abc }}</a></li>
          @else
            <li><a data-toggle="pill" href="#{{ $abc }}">{{ $abc }}</a></li>
          @endif
        @endforeach
      </ul>

      <div class="tab-content">
        @foreach($abecedario as $abc)
          @if($abc == 'A')
            <div id="{{ $abc }}" class="tab-pane fade in active">
              <h3>HOME {{ $abc }}</h3>
              <p>Some content {{ $abc }}.</p>
            </div>
          @else
          <div id="{{ $abc }}" class="tab-pane fade">
            <h3>Menu {{ $abc }}</h3>
            <p>Some content in menu {{ $abc }}.</p>
          </div>
          @endif
        @endforeach
      </div>
    </div>
</div>
@endsection
