@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a href="{{ route('package.create') }}" class="btn btn-sm btn-info">New Package</a>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    @include('BackEnd.layouts.ErrorMessage')
                    <div class="pricing-table">
                        <div class="row row-cols-1 row-cols-lg-3">
                            @foreach($packages as $package)
                            <div class="col">
                                <div class="card mb-5 mb-lg-0">
                                    <div class="card-header bg-{{ $package->background_color }} py-3">
                                        <h5 class="card-title text-white text-uppercase text-center">
                                            {{ $package->package_name }}</h5>
                                        <h6 class="card-price text-white text-center">${{ $package->price }}
                                            <!-- <span class="term">/month</span> -->
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>{{ $package->post_number }}
                                                Number
                                                Of Post
                                            </li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>{{ $package->image_number }}
                                                Number
                                                of Image Per
                                                Post
                                            </li>
                                            <li class="list-group-item"><i
                                                    class='bx bx-check me-2 font-18'></i>{{ $package->publish_day }}
                                                Nmuber
                                                of Day
                                                Publish</li>
                                            @if($package->status==1)
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>Active
                                            </li>
                                            @else
                                            <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i>Inactive
                                            </li>
                                            @endif
                                        </ul>
                                        <div class="d-grid">
                                            @if($package->status==1)
                                            <a href="{{ route('package.Inactive',$package->id) }}"
                                                class="btn btn-danger my-2 radius-30">Inactive</a>
                                            @else
                                            <a href="{{ route('package.Active',$package->id) }}"
                                                class="btn btn-success my-2 radius-30">Active</a>
                                            @endif
                                            <a href="{{ route('package.edit',$package->id) }}"
                                                class="btn btn-primary my-2 radius-30">Edit</a>
                                            <button class="btn btn-danger my-2 radius-30" id="deletebtn"
                                                data-id="{{ $package->id }}">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '#deletebtn', function() {
    swal({
            title: "Are you sure?",
            text: "Once Cancel, you will not be able to recover this  data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var id = $(this).data("id");
                $.ajax({
                    type: "Delete",
                    url: "{{ url('Admin/Package/delete')}}" + '/' + id,
                    success: function(data) {

                        url = "{{ url('Admin/Package')}}",
                            window.location = url;
                    },
                    error: function(data) {
                        console.log(data);
                        swal("Opps! Faild", "Data Fail to Cancel", "error");
                    }
                });
                swal("Ok! Your file has been cancelled!", {
                    icon: "success",
                });
            } else {
                swal("Your file is safe!");
            }
        });
});
</script>

@endsection