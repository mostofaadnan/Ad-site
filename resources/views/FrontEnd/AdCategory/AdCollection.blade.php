@extends('FrontEnd.layouts.master_one')
@section('content')

<main>
    <section id="header-section ">
        <div class="container">
            <h3 class="text-center text-dark fw-bold my-3">
                Find {{ $subcategory->Categoryname->title }} on AD
                <strong class="text-primary">{{ $subcategory->title }}</strong>
            </h3>
        </div>
    </section>

    <!-- add collection -->
    <section id="add-collection">
        <div class="add-collection">
            <div class="container">
                @forelse($adposts as $date => $group)
                <div class="row my-3">
                    <p class="date col-lg-8 p-1">{{ $date }}</p>

                    @foreach($group as $post)
                    <div class="col-lg-12 post-collection-title">
                          <a class="post-link" href="{{route('AdDetails',$post->id)}}"><i class="fa-solid fa-arrow-right"></i> {{ Str::limit($post->title,25) }} 
                         @foreach($post->PostDetails as $details) 
                         @if($details->field_name=='Age')  
                        <span style="margin-left:10px;"><b>{{ $details->description }}</b></span>
                        @endif
                        @endforeach</a>
                    </div>
                    @endforeach

                </div>
                @empty
                <div class="row my-3">
                    <h4 class="" style="color:red" align="center">Sorry! This Type of Ad Post not Yet <a
                            href="{{ route('fronthome') }}">Back</a></h4>
                </div>
                @endforelse
                <div class="float-right">
                   
                </div>
                <!--  <div class="row">
                    <div class="col-12">
                        <div class="pagination-bar">

                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
</main>

@endsection
