@extends('layouts.app')

@section('title', 'Question Bank')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Bank Soal - Tugas 2 LZCDR</h1>
                <div class="section-header-button">
                    <a href="{{route('question.create')}}"
                        class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Questions</a></div>
                    <div class="breadcrumb-item">Question Bank</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Question Bank</h2>
                <p class="section-lead">
                    You can manage all questions, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Question Bank</h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="float-right col-lg-4 col-md-4 col-sm-12">
                                    <form method="GET" action="{{route('question.index')}}">
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
                                            <th>ID</th>
                                            <th>Question</th>
                                            <th>Category</th>
                                            <th>Option 1</th>
                                            <th>Option 2</th>
                                            <th>Option 3</th>
                                            <th>Option 4</th>
                                            <th>Created</th>
                                        </tr>
                                        @foreach ($questions as $soal)
                                        <tr>
                                            <td>{{$soal->id}}</td>
                                            <td>{{Str::limit($soal->question, 40)}}
                                                <div class="table-links">
                                                    <a href="{{route('question.edit', $soal->id)}}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('delete-question-{{$soal->id}}').submit()"
                                                        class="text-danger">Delete</a>
                                                    <form action="{{route('question.destroy', $soal->id)}}"
                                                        method="POST"
                                                        id="delete-question-{{$soal->id}}"
                                                        class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                {{$soal->category}}
                                            </td>
                                            <td>
                                                {{$soal->answer_1}}
                                            </td>
                                            <td>
                                                {{$soal->answer_2}}
                                            </td>
                                            <td>
                                                {{$soal->answer_3}}
                                            </td>
                                            <td>
                                                {{$soal->answer_4}}
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($soal->created_at)->diffForHumans()}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{$questions->withQueryString()->links()}}
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
    <script src="{{ asset('js/page/features-users.js') }}"></script>
@endpush
