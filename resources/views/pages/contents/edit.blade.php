@extends('layouts.app')

@section('title', 'Edit Content')

@push('style')
  <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Content</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{route('content.index')}}">Contents</a></div>
        <div class="breadcrumb-item">Edit Content</div>
      </div>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <h4>Edit Content</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('content.update', $content->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label>Section</label>
              <input type="text" name="section" class="form-control @error('section') is-invalid @enderror"
                value="{{$content->section}}">
              @error('section')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Content</label>
              <textarea name="content" class="summernote-simple @error('content') is-invalid @enderror">{{$content->content}}</textarea>
              @error('content')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="col-form-label text-md-right"></label>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>
@endsection

@push('scripts')
  <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
@endpush