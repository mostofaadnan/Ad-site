@extends('BackEnd.layouts.app')
@section('wrapper')
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link
    href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
    rel="stylesheet">


<script type="text/javascript" src="{{asset('assets/FrontEnd/ImageUploader/image-uploader.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/x16bdhjkeyrsv2vmjrgbilj5x5idshzxa5pg2rptyvglnplz/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">New Page</h4>
            </div>
            <div class="card-body">
                @include('BackEnd.layouts.ErrorMessage')
                <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$page->id}}" name="id">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $page->title }}"
                            placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="20" class="form-control">
                            <?php
$filename = 'page-' . $page->id . '.txt';
$files = storage_path("app/public/page/$filename");
if (file_exists($files)) {
    $file = fopen(storage_path("app/public/page/$filename"), "r") or exit("Unable to open file!");
    while (!feof($file)) {
        echo fgets($file);
    }

    fclose($file);
}

?>
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                @if($page->status==1)
                                <option value="1">Publish</option>
                                @else
                                <option value="2">Draft</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="float-end">
                        <button type="submit" class="btn btn-lg btn-success">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
tinymce.init({
    selector: 'textarea#description',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false,
});
</script>
@endsection