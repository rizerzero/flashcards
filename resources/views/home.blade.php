@extends('layout')

@section('content')
<h1>Home Page</h1>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          You are logged in!

          @livewire('counter')
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <p><a href="{{ route('logout') }}">Log out</a></p>
</div>
@stop
