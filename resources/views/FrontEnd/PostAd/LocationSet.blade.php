@extends('FrontEnd.layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
<style>

</style>
<!-- location section -->
<main>
    <div class="container">
        <div class="link-bar">
            <a href="{{route('fronthome') }}">Home</a>
            > <a href="{{ route('user.dashboard') }}">My Account</a>
            > <a href="{{  route('adpost.locationSet')}}" class="active">Select Location</a>
        </div>
    </div>

    <section id="location-section mb-2">
        <div class="container">
            <h3 style="color: #4e52d0" class="my-5">Please select Ad Location:</h3>
            <div class="row">
                @foreach($lists as $list)
                <div class="col-sm-12 location-state-box">
                    <div class="location-box">
                        <div class="bd-example" data-example-id="">
                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <div class="mb-0">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseOne{{$list->id}}" aria-expanded="false"
                                                aria-controls="collapseOne" class="collapsed">
                                                <h5>{{ $list->name }}</h5>
                                            </a>
                                        </div>
                                    </div>

                                    @foreach($list->StateList as $statelist)
                                    @if(Count($statelist->CityList))

                                    <div class="card-body location-state-box collapse" id="collapseOne{{$list->id}}"
                                        class="collapse" role="tabpanel" aria-labelledby="headingOne"
                                        aria-expanded="false">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseTwo{{ $statelist->id }}" aria-expanded="false"
                                            aria-controls="collapseOne{{$list->id}}"
                                            class="collapsed">{{ $statelist->name  }}</a>

                                        <div class="float-right"><a href="{{ route('adpost.postcategoryByState', $statelist->id) }}" class="btn" data-toggle="tooltip" title="Post All City"><i
                                                    class="fa-solid fa-arrow-right-to-bracket"></i></a></div>
                                        <div class="card-body collapse" id="collapseTwo{{ $statelist->id }}"
                                            class="collapse" role="tabpanel" aria-labelledby="headingOne"
                                            aria-expanded="false">
                                            <div class="row citylist">

                                                @foreach($statelist->CityList as $city)
                                                <div class="col-sm-3">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('adpost.postcategory', $city->id) }}">{{ $city->name }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endforeach
                                            </div>

                                        </div>

                                    </div>
                                    @endif
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </section>
</main>
@endsection