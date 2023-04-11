@extends('layouts.backend-layout')

@section('CssPart')

@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-5">
                    <div class="card-header pageTitle">
                        <h1 class="text-center mb-4 title mt-3 pageTitle">新增公告</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('backend-announcements.store') }}" enctype="multipart/form-data">
                            @csrf



                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('標題') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control-file @error('title') is-invalid @enderror" name="title" onchange="previewImage(this);">
                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('內文') }}</label>

                                <div class="col-md-6">
                                    <textarea id="content" type="text" class="form-control @error('name') is-invalid @enderror" name="content" required autocomplete="name" autofocus>
                                        {{ old('content') }}
                                    </textarea>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 mt-3">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary px-4">新增</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
