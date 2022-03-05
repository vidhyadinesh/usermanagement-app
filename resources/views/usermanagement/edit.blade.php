@extends('layout.app')
@section('title', 'Edit User')
@section('heading', 'Edit This User')
@section('link_text', 'Goto All Users')
@section('link', '/usermanagement')

@section('content')

<div class="row my-3">
  <div class="col-lg-8 mx-auto">
    <div class="card shadow">
      <div class="card-header bg-primary">
        <h3 class="text-light fw-bold">Edit User</h3>
      </div>
      <div class="card-body p-4">
        <form action="/usermanagement/{{ $usermanagement->id }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="my-2">
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $usermanagement->name }}" required>
          </div>

          <div class="my-2">
            <input type="text" name="age" id="age" class="form-control" placeholder="Age" value="{{ $usermanagement->age }}" required>
          </div>

          <div class="my-2">
            <input type="file" name="file" id="file" accept="image/*" class="form-control">
          </div>

          <img src="{{ asset('storage/images/'.$usermanagement->image) }}" class="img-fluid img-thumbnail" width="150">

          

          <div class="my-2">
            <input type="submit" value="Update User" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection