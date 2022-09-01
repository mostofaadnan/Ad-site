@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <div class="container">
        <div class="link-bar">
            <a href="{{route('fronthome') }}">Home</a>
            <i class="fa-solid fa-arrow-right-long"></i><a href="{{ route('front.page',$page->id) }}" class="active">{{ $page->title }}</a>
        </div>

        <div class="page_content">
            <h4 align="center">{{ $page->title }}</h4>
            <hr>
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



        </div>
    </div>
</main>
@endsection