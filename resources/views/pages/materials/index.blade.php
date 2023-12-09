@extends('layouts.app')

@section('title', 'Materials')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Materials</h1>
                <div class="section-header-button">
                    <a href="{{route('material.create')}}"
                        class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Material</a></div>
                    <div class="breadcrumb-item">All Materials</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Materials</h2>
                <p class="section-lead">
                    You can manage all materials, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Materials</h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="float-right col-lg-4 col-md-4 col-sm-12">
                                    <form method="GET" action="{{route('material.index')}}">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                        </tr>
                                        @foreach ($materials as $material)
                                        <tr>
                                            <td>
                                                <img alt="image"
                                                    src="{{$material->image_url}}"
                                                    width="35"
                                                    data-toggle="tooltip" title="{{$material->section}}">
                                            </td>
                                            <td>{{$material->title}}
                                                <div class="table-links">
                                                    <a href="{{route('material.edit', $material->id)}}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('delete-content-{{$material->id}}').submit()"
                                                        class="text-danger">Delete</a>
                                                    <form action="{{route('material.destroy', $material->id)}}"
                                                        method="POST"
                                                        id="delete-content-{{$material->id}}"
                                                        class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                {{Str::limit($material->content, 40)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{$materials->withQueryString()->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-contents.js') }}"></script>
@endpush
