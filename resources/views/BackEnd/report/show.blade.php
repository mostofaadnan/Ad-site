@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>Post Report</h4>
                </div>
            </div>
            <div class="card-body">
                @include('FrontEnd.PostAd.ErrorMessage')
                <a href="{{route('PostManages.show',$AdpostReport->PostDetails->id)}}">
                    <h5>Report On:{{ $AdpostReport->PostDetails->title }}</h5>
                </a>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="exampleRadios1" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            {{ $AdpostReport->ReportOption->name }}
                        </label>
                    </div>
                </div>
                <p>{{ $AdpostReport->description }}</p>

            </div>
        </div>
    </div>
</div>
@endsection