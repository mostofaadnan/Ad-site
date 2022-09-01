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
            <i class="fa-solid fa-arrow-right-long"></i><a href="" class="active">Manage
                Post</a>
        </div>
    </div>

    <section class="make-post">
        <form action="{{ route('adpost.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $adpost->id }}">
            <div class="container">
                <h3 style="color: #4e52d0" class="my-5">Post Manage</h3>
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
                                        href="{{ route('adpost.edit',Session::get('id')) }}"><b>Manage Post</b></a></li>
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
                        @if($adpost->city_id==0)
                        <div class="form-group">
                            <label for="title">Location
                                <!-- <a href="{{ route('adpost.locationSet') }}"
                                    style="text-decoration:underline;">Change</a> -->
                            </label>
                            <input type="text" class="form-control"
                                value="All City, {{ $adpost->StateName->name }}, {{ $adpost->CountryName->name }}"
                                disabled>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="title">Location
                                <!-- <a href="{{ route('adpost.locationSet') }} "
                                    style="text-decoration:underline;">Change</a> -->
                            </label>
                            <input type="text" class="form-control"
                                value="{{ $adpost->CityName->name }}, {{ $adpost->StateName->name }}, {{ $adpost->CountryName->name }}"
                                disabled>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Category
                                <!-- <a href="{{ route('adpost.category') }}"
                                    style="text-decoration:underline;">Change</a> -->
                            </label>
                            <input type="text" class="form-control" value="{{ $adpost->CategoryName->title }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Sub-Category
                                <!-- <a
                                    href="{{ route('adpost.postSubcategory',$adpost->category_id) }}"
                                    style="text-decoration:underline;">Change</a> -->
                            </label>
                            <input type="text" class="form-control" value="{{ $adpost->SubCategoryname->title }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="" placeholder="Titile" class="form-control"
                                value="{{ $adpost->title }}" maxlength="200">
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
                                placeholder="Description" maxlength="4000">  <?php
$filename = 'details-' . $adpost->id . '.txt';
$files = storage_path("app/public/post/description/$filename");
if (file_exists($files)) {
    $file = fopen(storage_path("app/public/post/description/$filename"), "r") or exit("Unable to open file!");
    while (!feof($file)) {
        echo fgets($file);
    }
    fclose($file);
}?></textarea>
                            <span>*Maximum 4000 words</span>
                        </div>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @if($adpost->CategoryName->post_field_type==2)
                <div class="row">
                    @foreach($postdetails as $posttype)
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="{{$posttype->field_name}}">{{ $posttype->field_name }}</label>
                            @if($posttype->PostType->field_type=='textarea')
                            <textarea name="{{ $posttype->PostType->field_name }}" cols="30" rows="5"
                                class="form-control"
                                placeholder="{{ $posttype->PostType->field_label }}">{{ $posttype->description }}</textarea>
                            @else
                            <input type="{{ $posttype->PostType->field_type }}"
                                name="{{ $posttype->PostType->field_name }}" class="form-control"
                                placeholder="{{ $posttype->PostType->field_label }}"
                                value="{{ $posttype->description }}" require>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @if($adpost->CategoryName->adult_content==1)
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Which gender(s) do you offer services to?*">Which gender(s) do you offer
                                services to?*</label><br>
                            <label class="radio-inline"><input type="radio" name="service" value="Man"
                            @if(!is_null($service)) {{ ($service->description=="Man")? "checked" : "" }}@endif>
                                Man</label>
                            <label class="radio-inline"><input type="radio" name="service"
                            @if(!is_null($service)) {{ $service->description=='Women'? 'checked' :'' }}@endif value="Women"> Women</label>
                            <label class="radio-inline"><input type="radio" name="service"
                            @if(!is_null($service)) {{ $service->description=='Couple'? 'checked' :'' }}@endif value="Couple">
                                Couple</label>
                        </div>
                        <div class="form-group">
                            <label for="Incall">Incall:</label><br>
                            <label class="radio-inline"><input type="radio" name="incall"
                            @if(!is_null($incall)){{ $incall->description=='Yes'? 'checked' :'' }}@endif value="Yes">
                                Yes</label>
                            <label class="radio-inline"><input type="radio" name="incall"
                            @if(!is_null($incall)){{ $incall->description=='No'? 'checked' :'' }}@endif value="No">No</label>
                        </div>

                        <div class="form-group">
                            <label for="outcall">Out Call:</label><br>
                            <label class="radio-inline"><input type="radio" name="outcall"
                            @if(!is_null($outcall)){{ $outcall->description=='Yes'? 'checked' :'' }}@endif value="Yes">
                                Yes</label>
                            <label class="radio-inline"><input type="radio" name="outcall"
                            @if(!is_null($outcall)){{ $outcall->description=='No'? 'checked' :'' }}@endif value="No"> No</label>
                        </div>
                        <div class="form-group">
                            <label for="sexual orientation">Sexual Orientation*</label>
                            <label class="radio-inline"><input type="radio" name="sexual_orientation"
                            @if(!is_null($sexual_orientation)) {{ $sexual_orientation->description=='Heterosexual'? 'checked' :'' }}@endif
                                    value="Heterosexual">Heterosexual</label>
                            <label class="radio-inline"><input type="radio" name="sexual_orientation"
                            @if(!is_null($sexual_orientation)){{ $sexual_orientation->description=='Homosexual'? 'checked' :'' }}@endif
                                    value="Homosexual">Homosexual</label>
                            <label class="radio-inline"><input type="radio" name="sexual_orientation"
                            @if(!is_null($sexual_orientation)){{ $sexual_orientation->description=='Bisexual'? 'checked' :'' }}@endif
                                    value="Bisexual">Bisexual</label>
                            <label class="radio-inline"><input type="radio" name="sexual_orientation"
                            @if(!is_null($sexual_orientation)){{ $sexual_orientation->description=='Asexual'? 'checked' :'' }}@endif
                                    value="Asexual">Asexual</label>
                        </div>

                    </div>
                </div>
                @endif
                <div class="mt-2"></div>
                @if($postimage>0)
                <div class="row">
                    <div class="col-sm-12">
                        <p><b>Preview Image</b></p><br>
                        <div class="row">
                            @foreach($adpost->ImagePost as $imageFile)
                            @if($imageFile->image)
                            <div class="col-sm-2 imgUp">
                                <div>
                                    <img src="{{ asset('image/post/'.$imageFile->image) }}" class="background-image"
                                        alt="" width="160px" height="140px">
                                </div>
                                <button class="btn btn-danger deletedata" data-id="{{ $imageFile->id }}"
                                    style="width:160px;color:#fff;">Delete</button>
                                </label>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div><!-- row -->
                </div>
                @endif
                <div>

                    @if($imagelimit>0)
                    <div class="row">
                        <div class="col-sm-12">

                            <p>You are allow to {{ $imagelimit }} image for this Post</p><br>
                            <div class="row">

                                @for($i=1; $i<=$imagelimit; $i++) <div class="col-sm-2 imgUp">
                                    <div class="imagePreview"></div>
                                    <label class="btn btn-primary">
                                        Upload<input type="file" name="images[]" class="uploadFile img"
                                            value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                    </label>
                            </div>
                            @endfor
                        </div>
                    </div>
                    @endif
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
                                <option value="{{ $feature->id }}"
                                    {{$adpost->feature_id == $feature->id ? 'selected': ''}}>
                                    {{ $feature->total_day }}
                                    days
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
                                <option value="{{ $extend->id }}"
                                    {{$adpost->extend_day_id == $extend->id ? 'selected': ''}}>+{{ $extend->total_day }}
                                    days
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
                <!--      <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-controler" name="" type="checkbox" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I agree to receive newsletter emails.
                            </label>

                        </div>
                    </div>
                </div> -->
                <!--         <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-controler" name="agree_term" type="checkbox" value="1"
                                id="flexCheckDefault">
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
                </div> -->
                <input type="submit" value="Update" class="btn btn-info">
            </div>
        </form>
    </section>
</main>

<script>
$(document).ready(function() {
    $(".deletedata").on('click', function() {
        if (confirm("Are you sure?")) {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "post",
                url: "{{ url('DeleteImage/')}}" + '/' + id,
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    console.log(data);
                    alert("Fail To Delete Data")
                    /*  swal("Opps! Faild", "Data Fail to Cancel", "error"); */
                }
            });
        }
        return false;
    })
});


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