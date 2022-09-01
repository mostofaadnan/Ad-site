@extends('BackEnd.layouts.app')
@section('wrapper')

<div class="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-header card-header-section">
                        Edit Banner
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adbanners.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $addBanner->id  }}">
                            <div class="form-group mb-3">
                                <label for="exampleInputPassword2" class="col-form-label">Type</label>
                                <select name="type" class="form-control" id="type">
                                    <option value="1" {{ $addBanner->type==1?'selected':'' }}>Adsense</option>
                                    <option value="2" {{ $addBanner->type==2?'selected':'' }}>Custom</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2" class="col-form-label">Ad Title</label>
                                <input type="text" class="form-control" id="add_title" name="add_title"
                                    placeholder="Title" value="{{ $addBanner->add_title }}">
                            </div>

                            <div class="custom" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputPassword2" class="col-form-label">Link</label>
                                    <input type="text" class="form-control" name="link" value="{{$addBanner->link }}">
                                </div>
                                <div class="from-group mb-3">
                                    <label for="exampleInputPassword2" class="col-form-label">Image</label>
                                    @if ($addBanner->image)
                                    <img src="{{ asset('image/banner/'.$addBanner->image) }}" alt=""
                                        width="200px; height:200px;">
                                    @endif
                                    <input type="file" name="image">
                                </div>
                            </div>

                            <div class="adsense">
                                <div class="form-group">
                                    <label for="exampleInputPassword2" class="col-form-label">Source</label>
                                    <textarea name="source" class="form-control" id="source" cols="30" rows="6"
                                        placeholder="Source"><?php
$filename = 'src-' . $addBanner->id . '.txt';
$files = storage_path("app/public/banner/source/$filename");
if (file_exists($files)) {
    $file = fopen(storage_path("app/public/banner/source/$filename"), "r") or exit("Unable to open file!");
    while (!feof($file)) {
        echo fgets($file);
    }

    fclose($file);
}
?></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputPassword2" class="col-form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $addBanner->status==1?'selected':'' }}>Active</option>
                                    <option value="0" {{ $addBanner->status==0?'selected':'' }}>Deactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$("#type").on('change', function() {

    var type = $(this).val();
    if (type == "1") {
        $(".custom").hide();
        $(".adsense").show();
    } else {
        $(".custom").show();
        $(".adsense").hide();
    }
})
window.onload = function ShowType() {
    var type = "{{ $addBanner->type }}"
    if (type == 1) {
        $(".custom").hide();
        $(".adsense").show();
    } else {
        $(".custom").show();
        $(".adsense").hide();
    }
}
</script>
@endsection