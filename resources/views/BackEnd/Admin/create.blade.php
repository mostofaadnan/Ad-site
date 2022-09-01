@extends('BackEnd.layouts.app')
@section('wrapper')


<div class="page-wrapper">
    <div class="page-content">
        <style>
        .user-panel {
            box-shadow: none;
        }

        .image-body {
            margin: auto;
        }

        .img-upload {
            margin: auto;
            align-items: center;
        }

        .user-profile {
            box-shadow: none;
        }
        </style>
        <div class="row">
            <div class="col-sm-8 form-single-input-section">
                <div class="card">
                    <div class="card-header card-header-section">New User</div>

                    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @include('BackEnd.layouts.ErrorMessage')
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row mb-2">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-8">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                        <div class="col-md-8">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-8">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                        <div class="col-md-8">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>


                                    <div class="form-group row mb-2">
                                        <label for="branch-form"
                                            class="col-md-4 col-form-label text-md-right">Status</label>

                                        <div class="col-md-8">
                                            <select name="status" class="form-control" id="status">
                                                <option selected value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card user-profile">
                                        <div class="card-body image-body">
                                            <div class="main-img-preview">
                                                <img class="thumbnail img-preview"
                                                    src="{{ asset('image/user/avater.jpg') }}"
                                                    style="width:100px; height: 100px" name="image"
                                                    class="img-thumbnail" title="Preview Logo">
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class=" input-group">
                                                <input id="fakeUploadLogo" type="hidden"
                                                    class="form-control fake-shadow" placeholder="Choose File"
                                                    disabled="disabled">
                                                <div class="input-group-btn img-upload">
                                                    <div class="fileUpload btn btn-danger ">
                                                        <span><i class="glyphicon glyphicon-upload"></i> Upload</span>
                                                        <input id="logo-id" name="user_image" type="file"
                                                            class="attachment_upload">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer card-footer-section">

                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="submit" class="btn btn-success">
                                        Submit
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var brand = document.getElementById('logo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function() {
        document.getElementById('fakeUploadLogo').value = this.value.substring(12);
    };

    // Source: http://stackoverflow.com/a/4459419/6396981
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logo-id").change(function() {
        readURL(this);
    });
});
</script>

@endsection