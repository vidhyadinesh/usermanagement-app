@extends('layout.app')
@section('title', 'User Details')
@section('heading', 'User Details')
@section('link_text', 'Goto All Users')
@section('link', '/usermanagement')

@section('content')

<div class="row my-4">
  <div class="col-lg-8 mx-auto">
    <div class="card shadow">
      <img src="{{ asset('storage/images/'.$usermanagement->image) }}" class="img-fluid card-img-top">
      <div class="card-body p-5">
        <div class="d-flex justify-content-between align-items-center">
          <p class="btn btn-dark rounded-pill">{{ $usermanagement->name }}</p>
          <p class="lead">{{ \Carbon\Carbon::parse($usermanagement->created_at)->diffForHumans() }}</p>
        </div>

        <hr>
        <!--<h3 class="fw-bold text-primary">{{ $usermanagement->age }}</h3>-->
        <p>{{ $usermanagement->age }}</p>
      </div>
      <div class="card-footer px-5 py-3 d-flex justify-content-end">
        <a href="/usermanagement/{{$usermanagement->id}}/edit" class="btn btn-success rounded-pill me-2">Edit</a>
        <form action="/usermanagement/{{$usermanagement->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger rounded-pill">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection