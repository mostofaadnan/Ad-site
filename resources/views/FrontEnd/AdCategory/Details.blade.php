@extends('FrontEnd.layouts.master')
@section('content')
<!-- main -->
<main>
    <!-- ad description -->
    <section id="ad-description">
        <div class="container">
            <div class="ad-box">
                <div class="card mx-auto" style="width: 80%">
                    <h3 class="card-title p-5">
                        {{ $adpost->title }}
                    </h3>
                    <div class="container text-center">
                        @foreach($adpost->ImagePost as $imageFile)
                        @if($imageFile->image)
                        <div class="container__img-holder mx-auto">
                            <img src="{{ asset('image/post/'.$imageFile->image) }}" alt="Image" />
                        </div>
                        @endif
                        @endforeach

                    </div>

                    <div class="img-popup">
                        <img src="" alt="Popup Image" />
                        <div class="close-btn">
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    </div>
                    <div class="warning container mt-2">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <h3> Please use your common sense before making any Pre-Payment
                            (Mainly GIFT CARDS): Back Delights will NOT be responsible for
                            any financial Losses! </h3>
                    </div>
                    <div class="card-body">
                        <p class="text-dark mb-1">
                            <strong>Posted on:</strong> {{  $postdate }}
                        </p>
                        <p class="text-dark">
                            <strong>Expires On: </strong> {{ $adpost->ending_date }}
                        </p>
                        <p>
                            <i class="fa-solid fa-location-dot"></i> Location :
                            <strong class="text-dark">{{ $adpost->StateName->name }}</strong>
                        </p>
                        @if($adpost->details==1)
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="container table-responsive py-5">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">User Info</th>
                                                <th scope="col">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark fw-bold">
                                            @foreach($adpost->PostDetails as $details)
                                            <tr>
                                                <td>{{ $details->field_name  }}</td>
                                                <td>{{ $details->description  }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif


                        <p class="card-text">
                            <!--          {{ $adpost->description }} -->

                            <?php
$filename = 'details-' . $adpost->id . '.txt';
$files = storage_path("app/public/post/description/$filename");
if (file_exists($files)) {
    $file = fopen(storage_path("app/public/post/description/$filename"), "r") or exit("Unable to open file!");
    while (!feof($file)) {
        echo fgets($file);
    }

    fclose($file);
}

?>
                        </p>

                        <div class="contact-btn text-center">
                            <a href="{{ route('Report.create',$adpost->id) }}" class="btn btn-primary mx-auto">Report
                                AD</a>
                           <!--  <a href="{{ route('Emailad.create', $adpost->id)}}" class="btn btn-primary mx-auto">Email This AD</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection