@extends('layouts.app')

@section('title', 'Edit User')

@push('style')

@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit User</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{route('user.index')}}">Users</a></div>
        <div class="breadcrumb-item">Edit User</div>
      </div>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <h4>Edit User</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('user.update', $user->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{$user->name}}">
              @error('name')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                      <i class="fas fa-envelope"></i>
                  </div>
                </div>

                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                  value="{{$user->email}}">
                @error('email')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label>Phone</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                      <i class="fas fa-phone"></i>
                  </div>
                </div>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                  value="{{$user->phone}}">
                  @error('phone')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Roles</label>
              <div class="selectgroup w-100">
                  <label class="selectgroup-item">
                      <input type="radio"
                          name="roles"
                          value="admin"
                          class="selectgroup-input"
                          {{$user->roles == 'admin' ? 'checked' : ''}}>
                      <span class="selectgroup-button">Admin</span>
                  </label>
                  <label class="selectgroup-item">
                      <input type="radio"
                          name="roles"
                          value="staff"
                          class="selectgroup-input"
                          {{$user->roles == 'staff' ? 'checked' : ''}}>
                      <span class="selectgroup-button">Staff</span>
                  </label>
                  <label class="selectgroup-item">
                      <input type="radio"
                          name="roles"
                          value="user"
                          class="selectgroup-input"
                          {{$user->roles == 'user' ? 'checked' : ''}}>
                      <span class="selectgroup-button">User</span>
                  </label>
              </div>
          </div>

          <div class="form-group">
            <label class="col-form-label text-md-right"></label>
                <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </div>
      </div>
    </div>

  </section>
@endsection

@push('scripts')
@endpush