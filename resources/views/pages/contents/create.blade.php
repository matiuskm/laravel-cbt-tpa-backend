@extends('layouts.app')

@section('title', 'New Content')

@push('style')
  <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>New Content</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{route('content.index')}}">Contents</a></div>
        <div class="breadcrumb-item">New Content</div>
      </div>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <h4>New Content</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('content.store')}}">
            @csrf
            <div class="form-group">
              <label>Section</label>
              <input type="text" name="section" class="form-control @error('section') is-invalid @enderror"
                value="{{old('section')}}">
              @error('section')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Content</label>
              <textarea name="content" class="summernote-simple @error('content') is-invalid @enderror"></textarea>
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
</div>
@endsection

@push('scripts')
  <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
@endpush