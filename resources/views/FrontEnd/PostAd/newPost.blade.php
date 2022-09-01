@extends('FrontEnd.layouts.master')
@section('content')


<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link
    href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
    rel="stylesheet">
<script src="https://cdn.tiny.cloud/1/x16bdhjkeyrsv2vmjrgbilj5x5idshzxa5pg2rptyvglnplz/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>

<style>
.input-field label.active {
    -webkit-transform: translateY(-15px) scale(0.8);
    transform: translateY(-15px) scale(0.8);
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0;
}

.btn-primary {
    display: block;
    border-radius: 0px;
    box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
    margin-top: -5px;
}
</style>
<main>
    <div class="container">
        <div class="link-bar">
            <a href="{{route('fronthome') }}">Home</a>
            <i class="fa-solid fa-arrow-right-long"></i><a href="{{ route('user.dashboard') }}">My Account</a>
            <i class="fa-solid fa-arrow-right-long"></i> <a href="{{  route('adpost.locationSet')}}"
                class="active">Select Location</a>
            <i class="fa-solid fa-arrow-right-long"></i><a href="{{ route('adpost.category') }}" class="active">Select
                Category</a>
            <i class="fa-solid fa-arrow-right-long"></i><a href="#" class="active">Select Sub Category</a>
            <i class="fa-solid fa-arrow-right-long"></i><a href="" class="active">Make
                Post</a>
        </div>
    </div>

    <section class="make-post">
        <form action="{{ route('adpost.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <h3 style="color: #4e52d0" class="my-5">Make a Post:</h3>
                <div class="row">
                    <div class="col-sm-8">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="ms-3">
                                <h6 class="mb-0 text-success">Success</h6>
                                <div>{{Session::get('success')}}</div>
                            </div>
                            <ul class="list-inline">
                                <li class="list-inline-item pt-0 pr-1 pb-0 pl-0"><a
                                        href="{{ route('AdDetails',Session::get('id')) }}"><b>View Post</b></a></li>
                                <li class="list-inline-item pt-0 pr-1 pb-0 pl-0"><a
                                        href="{{ route('user.ManagePost') }}"><b>Manage Post</b></a></li>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-8">
                        @if($city_id==0)
                        <div class="form-group">
                            <label for="title">Location <a href="{{ route('adpost.locationSet') }} "
                                    style="text-decoration:underline;">Change</a></label>
                            <input type="text" class="form-control"
                                value="All City, {{ $state->name }}, {{ $country->name }}" disabled>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="title">Location <a href="{{ route('adpost.locationSet') }} "
                                    style="text-decoration:underline;">Change</a></label>
                            <input type="text" class="form-control"
                                value="{{ $city->name }}, {{ $state->name }}, {{ $country->name }}" disabled>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Category <a href="{{ route('adpost.category') }}"
                                    style="text-decoration:underline;">Change</a></label>
                            <input type="text" class="form-control" value="{{ $category->title }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Sub-Category <a
                                    href="{{ route('adpost.postSubcategory',$category->id) }}"
                                    style="text-decoration:underline;">Change</a></label>
                            <input type="text" class="form-control" value="{{ $subcategory->title }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="" placeholder="Ttile" class="form-control"
                                value="{{ old('title') }}" maxlength="200">
                            <span>*Maximum 200 words</span>
                        </div>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                                placeholder="Description" maxlength="4000">{{ old('description') }}</textarea>
                            <span>*Maximum 4000 words</span>
                        </div>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                @if($category->post_field_type==2)
                <div class="row">
                    @foreach($category->PostType as $posttype)
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="{{$posttype->field_label}}">{{ $posttype->field_label }}</label>
                            @if($posttype->field_type=='textarea')
                            <textarea name="{{ $posttype->field_name }}" cols="30" rows="5" class="form-control"
                                placeholder="{{ $posttype->field_label }}"></textarea>
                            @elseif($posttype->field_type=='gender-option')
                            <br>
                            <label class="radio-inline"><input type="radio" name="{{ $posttype->field_name }}" checked value="Male">
                                Male</label>
                            <label class="radio-inline"><input type="radio" name="{{ $posttype->field_name }}" value="Female">Female</label>
                            @else
                            <input type="{{ $posttype->field_type }}" name="{{ $posttype->field_name }}"
                                class="form-control" placeholder="{{ $posttype->field_label }}" require>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
                @endif

                @if($category->adult_content==1)
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Which gender(s) do you offer services to?*">Which gender(s) do you offer
                                services to?*</label><br>
                            <label class="radio-inline"><input type="radio" name="service" checked value="Man">
                                Man</label>
                            <label class="radio-inline"><input type="radio" name="service" value="Women"> Women</label>
                            <label class="radio-inline"><input type="radio" name="service" value="Couple">
                                Couple</label>
                        </div>


                        <div class="form-group">
                            <label for="Incall">Incall:</label><br>
                            <label class="radio-inline"><input type="radio" name="incall" checked value="Yes">
                                Yes</label>
                            <label class="radio-inline"><input type="radio" name="incall" value="No"> No</label>
                        </div>

                        <div class="form-group">
                            <label for="outcall">Out Call:</label><br>
                            <label class="radio-inline"><input type="radio" name="outcall" checked value="Yes">
                                Yes</label>
                            <label class="radio-inline"><input type="radio" name="outcall" value="No"> No</label>
                        </div>


                        <div class="form-group">
                            <label for="sexual orientation">Sexual Orientation*</label>
                            <!--  <input type="text" class="form-control" name="sexual_orientation"
                                placeholder="sexual orientation"> -->
                            <label class="radio-inline"><input type="radio" name="sexual_orientation" checked
                                    value="Heterosexual">Heterosexual</label>
                            <label class="radio-inline"><input type="radio" name="sexual_orientation"
                                    value="Homosexual">Homosexual</label>
                            <label class="radio-inline"><input type="radio" name="sexual_orientation"
                                    value="Bisexual">Bisexual</label>
                            <label class="radio-inline"><input type="radio" name="sexual_orientation"
                                    value="Asexual">Asexual</label>
                        </div>

                    </div>
                </div>
                @endif
                <div class="mt-2"></div>
                <div class="row">
                    <div class="col-sm-12">
                        @if($userBalance>0)
                        <p>You are allow to {{ $imagelimit }} image for this Post</p><br>
                        <div class="row">

                            @for($i=1; $i<=$imagelimit; $i++) <div class="col-sm-2 imgUp">
                                <div class="imagePreview"></div>
                                <label class="btn btn-primary">
                                    Upload<input type="file" name="images[]" class="uploadFile img" value="Upload Photo"
                                        style="width: 0px;height: 0px;overflow: hidden;">
                                </label>
                        </div>
                        @endfor
                    </div>
                    @endif
                </div><!-- row -->
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Promote your ad</h4>
                    <div class="form-group">
                        <label for="FeaturedAd">Featured Ad</label>
                        <p>Featured ads are placed top-most in each category and are shown highlighted. Select the
                            appropraite option from below if you want to make this a featured ad.</p>
                        <select name="feature_id" id="" class="form-control">
                            <option value="0">None</option>
                            @foreach($features as $feature)
                            <option value="{{ $feature->id }}">{{ $feature->total_day }} days
                                (${{ $feature->amount }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="FeaturedAd">Extended Ad</label>
                        <p>Want to have your ad running longer? Consider buying one of the following promotions.</p>
                        <select name="extend_day_id" id="" class="form-control">
                            <option value="0">None</option>
                            @foreach($extends as $extend)
                            <option value="{{ $extend->id }}">+{{ $extend->total_day }} days
                                (${{ $extend->amount }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="mail">Your Mail: <b>{{ Auth::user()->email }}</b></label>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="defaultGroupExample6"
                                name="display_email" value="0">
                            <label class="custom-control-label" for="defaultGroupExample6">Do not display my
                                email</label>
                        </div>

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="defaultGroupExample7"
                                name="display_email" value="1" checked>
                            <label class="custom-control-label" for="defaultGroupExample7">Display my email on the
                                site
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!--     <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-controler" name="" type="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            I agree to receive newsletter emails.
                        </label>

                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-controler" name="agree_term" type="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            I agree to the <a href="#">terms of use</a> by making a post
                        </label>
                        @error('agree_term')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                @if($postAbility==0)
                @if($category->per_post_charge>$userBalance)

                <div class="col-sm-12">
                    <p>For post this ad you mustbe have ${{ $category->per_post_charge }}</p>
                    <h4 style="color:red;"> Your Credit: ${{ $userBalance }}</h4>
                    <a href="{{ route('user.reloadBalance') }}" class="btn btn-sm btn-success">Buy Credits</a>
                </div>

                @endif
                @endif
            </div>

            @if($postAbility>0)
            <input type="submit" value="Post Now" class="btn btn-info">
            @endif


            </div>
        </form>
    </section>
</main>

<div class="modal fade" id="postinsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLongTitle">Post Insert</h5> -->
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body" style="padding:30px;">
                @if(Session::has('success'))
                <div class="row align-items-center justify-content-center">
                    <h3 align="center" style="color:green;">{{Session::get('success')}}</h3>
                    <div class="col-sm-8 d-flex justify-content-center" style="margin-top:30px; margin-bottom:30px;">
                        <img class="mx-auto align-items-cente" src="{{ asset('assets/FrontEnd/image/smileemo.png') }}"
                            width="150px" height="150px">
                    </div>
                    <div class="col-sm-8 d-flex justify-content-center">
                        <a href="{{ route('AdDetails',Session::get('id')) }}" class="btn btn-lg btn-info"
                            style="margin:5px;">View
                            Post</a>
                        <a href="{{ route('adpost.locationSet') }}" class="btn btn-lg btn-info" style="margin:5px;">New
                            Post</a>
                    </div>
                </div>

                @endif
            </div>
            <!--   <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div> -->
        </div>
    </div>
</div>

<script>
$(".imgAdd").click(function() {
    $(this).closest(".row").find('.imgAdd').before(
        '<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" name="images[]" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>'
    );
});
$(document).on("click", "i.del", function() {
    // 	to remove card
    $(this).parent().remove();
    // to clear image
    // $(this).parent().find('.imagePreview').css("background-image","url('')");
});
$(function() {
    $(document).on("change", ".uploadFile", function() {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function() { // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" +
                    this.result + ")");
            }
        }

    });
});
$("#description").keyup(function() {
    var value = $(this).val();
    $("#preview").val(value);
});


//Mim098730
tinymce.init({
    selector: 'textarea#description',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false,
});
</script>
@endsection
