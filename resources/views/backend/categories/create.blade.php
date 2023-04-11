@extends('layouts.backend-layout')

@section('CssPart')

@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-5">
                    <div class="card-header pageTitle">
                        <h1 class="text-center mb-4 title mt-3 pageTitle">新增商品分類</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('backend-categories.store') }}" enctype="multipart/form-data">
                            @csrf



                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('相片') }}</label>

                                <div class="col-md-6">
                                    <input id="photo" type="file" class="form-control-file @error('photo') is-invalid @enderror" name="photo" onchange="previewImage(this);">
                                    <img id="preview" src="{{ asset('images/placeholder.png') }}" alt="Preview Image" style="max-width: 100%; margin-top: 10px; display: none;">

                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('名稱') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                    $('#preview').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
