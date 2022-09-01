<section id="about-us">
    <div class="container content-box">
        <h1 class="text-center my-5 text-dark fw-bold">About & FAQ</h1>
        <div class="row">
            @foreach($posts as $post)
            <div class="col-lg-6 mt-5">
                <h3 class="fs-3 about-header">
                    {{ $post->title }}
                </h3>
                <p class="text-dark mt-2">
                    <?php
$filename = 'post-' . $post->id . '.txt';
$files = storage_path("app/public/post/$filename");
if (file_exists($files)) {
    $file = fopen(storage_path("app/public/post/$filename"), "r") or exit("Unable to open file!");
    while (!feof($file)) {
        echo fgets($file);
    }

    fclose($file);
}

?>
                </p>
            </div>
            @endforeach

        </div>
    </div>
</section>