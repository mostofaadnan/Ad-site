@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <div class="container">
        <div class="card" style="border:none !important;">
         <!--    <div class="card-header">
                <h5>Post Report</h5>
            </div> -->
        </div>
        <div class="card-body">
            <h4 style="margin-bottom:20px;">Post Report</h4>
            <a href="{{route('AdDetails',$adPost->id)}}">
                <h5>Report On:{{ $adPost->title }}</h5>
            </a>
            @include('FrontEnd.PostAd.ErrorMessage')
            <form action="{{ route('Report.store') }}" method="POST">
                @csrf
                @foreach($reportOptions as $option)
                <div class="form-group">

                    <input type="hidden" name="post_id" value="{{ $adPost->id }}">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reportOption" id="exampleRadios1"
                            value="{{ $option->id }}">
                        <label class="form-check-label" for="exampleRadios1">
                            {{ $option->name }}
                        </label>
                    </div>
                </div>
                @endforeach
                <div class="form-group mb-2">
                    <label for="description">Description</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control"
                        placeholder="report description"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit Report</button>
            </form>
        </div>
    </div>
</main>
@endsection