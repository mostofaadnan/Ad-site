@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 align="center">Email this Ad</h4>
                <p><a href="{{route('AdDetails',$emailad->PostDetails->id)}}">{{ $emailad->PostDetails->title }}</a></p>
            </div>
            <div class="card-body">
                @include('FrontEnd.PostAd.ErrorMessage')
                <div class="form-group">
                    <p><b>Friend's name: </b>{{ $emailad->friend_name }}</p>
                </div>
                <div class="form-group">

                    <p><b>Friend's Email: </b> {{ $emailad->frends_email }}</p>

                </div>
                <div class="form-group">

                    <p><b>Your Name: </b> {{ $emailad->UserName->name }}</p>

                </div>
                <div class="form-group">

                    <p><b>Your Email: </b> {{ $emailad->UserName->email }}</p>

                </div>
                <div class="from-group mb-2">
                    <p>{{ $emailad->message }}</p>
                </div>


            </div>
        </div>
    </div>
</main>
@endsection
