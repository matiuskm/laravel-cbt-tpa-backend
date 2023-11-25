@extends('layouts.app')

@section('title', 'New Question')

@push('style')
<link rel="stylesheet"
href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>New Question</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{route('question.index')}}">Questions</a></div>
        <div class="breadcrumb-item">New Question</div>
      </div>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="card-header">
          <h4>New Question</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('question.store')}}">
            @csrf
            <div class="form-group">
              <label class="form-label">Category</label>
              <div class="selectgroup w-100">
                  <label class="selectgroup-item">
                      <input type="radio"
                          name="category"
                          value="Numeric"
                          class="selectgroup-input"
                          {{old('category') == 'Numeric' ? 'checked' : ''}}>
                      <span class="selectgroup-button">Numeric</span>
                  </label>
                  <label class="selectgroup-item">
                      <input type="radio"
                          name="category"
                          value="Verbal"
                          class="selectgroup-input"
                          {{old('category') == 'Verbal' ? 'checked' : ''}}>
                      <span class="selectgroup-button">Verbal</span>
                  </label>
                  <label class="selectgroup-item">
                      <input type="radio"
                          name="category"
                          value="Logika"
                          class="selectgroup-input"
                          {{old('category') == 'Logika' ? 'checked' : ''}}>
                      <span class="selectgroup-button">Logika</span>
                  </label>
              </div>
            </div>
            <div class="form-group">
              <label>Question</label>
              <textarea name="question" class="summernote-simple @error('question') is-invalid @enderror"></textarea>
              @error('question')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Option 1</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                      <i class="fa-solid fa-pencil"></i>
                  </div>
                </div>

                <input type="text" name="answer_1" class="form-control @error('answer_1') is-invalid @enderror"
                  value="{{old('answer_1')}}">
                @error('answer_1')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label>Option 2</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                      <i class="fa-solid fa-pencil"></i>
                  </div>
                </div>

                <input type="text" name="answer_2" class="form-control @error('answer_2') is-invalid @enderror"
                  value="{{old('answer_2')}}">
                @error('answer_2')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label>Option 3</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                      <i class="fa-solid fa-pencil"></i>
                  </div>
                </div>

                <input type="text" name="answer_3" class="form-control @error('answer_3') is-invalid @enderror"
                  value="{{old('answer_3')}}">
                @error('answer_3')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label>Option 4</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                      <i class="fa-solid fa-pencil"></i>
                  </div>
                </div>

                <input type="text" name="answer_4" class="form-control @error('answer_4') is-invalid @enderror"
                  value="{{old('answer_4')}}">
                @error('answer_4')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
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
  <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
@endpush