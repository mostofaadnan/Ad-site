<section style="margin-top:20px; padding:10px;right:0px;">
    <div class="add-banner">
        @foreach($adBanners as $addBanner)
        @if($addBanner->type==1)
        <?php
$filename = 'src-' . $addBanner->id . '.txt';
$files = storage_path("app/public/banner/source/$filename");
if (file_exists($files)) {
    $file = fopen(storage_path("app/public/banner/source/$filename"), "r") or exit("Unable to open file!");
    while (!feof($file)) {
        echo fgets($file);
    }

    fclose($file);
}
?>@else
        <div class="mb-2" style="margin-bottom:20px;">
            <a href="{{ $addBanner->link  }}"><img src="{{ asset('image/banner/'.$addBanner->image) }}" ></a>
        </div>
        @endif
        @endforeach
    </div>
</section>