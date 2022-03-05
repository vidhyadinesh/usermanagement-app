@extends('layout.app')
@section('title', 'Add New User')
@section('heading', 'Create a New User')
@section('link_text', 'Goto All Users')
@section('link', '/usermanagement')

@section('content')

<div class="row my-3">
  <div class="col-lg-8 mx-auto">
    <div class="card shadow">
      <div class="card-header bg-primary">
        <h3 class="text-light fw-bold">Add New User</h3>
      </div>
      <div class="card-body p-4">
        <form action="/usermanagement" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="my-2">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="my-2">
            <input type="number" name="age" id="age" class="form-control @error('age') is-invalid @enderror" placeholder="Age" value="{{ old('age') }}" >
            @error('ge')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="my-2">
            <input type="file" name="file" id="file" accept="image/*" class="form-control @error('file') is-invalid @enderror" >
            @error('file')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="my-2">
            <input type="submit" value="Add User" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection