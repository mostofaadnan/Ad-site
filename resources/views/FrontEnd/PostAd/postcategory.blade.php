@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <div class="container">
        <div class="link-bar">
        
        <a href="{{route('fronthome') }}">Home</a>
            > <a href="{{ route('user.dashboard') }}">My Account</a>
            > <a href="{{  route('adpost.locationSet')}}" class="active">Select Location</a>
            > <a href="" class="active">Select Category</a>
       
          </div>
    </div>
    <!-- category select section -->
    <section>
        <div class="container">
            <h3 style="color: #4e52d0" class="my-5">
                Please select a category to post to:
            </h3>
            <div class="row">

                @foreach($Categorys as $category)
                <div class="col-lg-3 my-2">
                    <div class="category-box py-5 border-lg">
                        <a href="{{ route('adpost.postSubcategory',$category->id) }}">{{ $category->title }}</a>
                    </div>
                </div>
                @endforeach




            </div>
        </div>
    </section>
</main>
@endsection