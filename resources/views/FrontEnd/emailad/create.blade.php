@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 align="center">Email this Ad</h4>
                <p><a href="{{route('AdDetails',$adPost->id)}}">{{ $adPost->title }}</a></p>
            </div>
            <div class="card-body">
                @include('FrontEnd.PostAd.ErrorMessage')
                <form action="{{ route('Emailad.store') }}" method="POST">
                    <input type="hidden" name="post_id" value="{{ $adPost->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Friend's name</label>
                        <input class="form-control" required type="text" name="friend_name" require>
                    </div>
                    <div class="form-group">
                        <label for="email">Friend's Email</label>
                        <input class="form-control" id="friends_email" required type="email" name="friends_email" require>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Name</label>
                        <input class="form-control" required type="text" name="Name" value="{{ Auth::user()->name  }}"
                            require>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input class="form-control" required type="email" name="Email" require
                            value="{{ Auth::user()->email  }}">
                    </div>
                    <div class="from-group mb-2">
                        <label for="message">Message</label>
                        <textarea name="message" id="" cols="30" rows="5" class="form-control" require></textarea>
                    </div>

                    <input class="btn btn-primary" type="submit" value="Submit" />
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
