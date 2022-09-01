@extends('BackEnd.layouts.app')
@section('wrapper')
<style>
.white-background {
    background-color: #fff !important;
}
</style>
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Post Details</h4>
            </div>
            <div class="card-body">

                <div class="container">

                    <div class="row">
                        @foreach($adpost->ImagePost as $imageFile)
                        @if($imageFile->image)
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img src="{{ asset('image/post/'.$imageFile->image) }}"
                                class="w-100 shadow-1-strong rounded mb-4 img-thumbnail" />
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="title">Post By</label>
                                <input type="text" class="form-control white-background"
                                    value="{{ $adpost->UserName->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="title">Post Date</label>
                                <input type="text" class="form-control white-background" value="{{ $adpost->date }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="title">Expire Date</label>
                                <input type="text" class="form-control white-background" value="{{ $adpost->ending_date }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Location</label>
                            @if($adpost->city_id==0)
                            <input type="text" class="form-control white-background"
                                value="All City, {{ $adpost->StateName->name }}, {{ $adpost->CountryName->name }} "
                                disabled>
                            @else
                            <input type="text" class="form-control white-background"
                                value="{{ $adpost->CityName->name }}, {{ $adpost->StateName->name }}, {{ $adpost->CountryName->name }} "
                                disabled>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">Category</label>
                                <input type="text" class="form-control white-background"
                                    value="{{ $adpost->CategoryName->title }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">Sub-Category</label>
                                <input type="text" class="form-control white-background"
                                    value="{{ $adpost->SubCategoryname->title }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" placeholder="Ttile" class="form-control white-background"
                                value="{{ $adpost->title }}" disabled>
                        </div>
                    </div>

                    <div class="row">
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
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="description">Description</label>
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="FeaturedAd">Featured Ad</label>
                                <select class="form-control">
                                    <option value="">None</option>
                                    @foreach($features as $feature)
                                    <option value="{{ $feature->id }}"
                                        {{$adpost->feature_id == $feature->id ? 'selected': ''}}>
                                        {{ $feature->total_day }} days
                                        (${{ $feature->amount }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="FeaturedAd">Extended Ad</label>
                                <select class="form-control">
                                    <option value="">None</option>
                                    @foreach($extends as $extend)
                                    <option value="{{ $extend->id }}"
                                        {{$adpost->extend_day_id == $extend->id ? 'selected': ''}}>
                                        +{{ $extend->total_day }} days
                                        (${{ $extend->amount }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="FeaturedAd">Status</label>

                                <select class="form-control">
                                    @if($adpost->status == 1)
                                    <option value="1">Active</option>
                                    @else
                                    <option value="0">inactive</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-end">
                    @if($adpost->status == 1)
                    <a href="{{ route('PostManages.inactive', $adpost->id) }}" class="btn btn-sm btn-danger">Inactive</a>
                    @else
                    <a href="{{ route('PostManages.active', $adpost->id) }}" class="btn btn-sm btn-success">Active</a>
                    @endif
                    <button class="btn btn-sm btn-danger" id="deletebtn" data-id="{{ $adpost->id }}">Delete</button>
                </div>
            </div>
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
                    url: "{{ url('Admin/PostManage/delete')}}" + '/' + id,
                    success: function(data) {
                        url = "{{ url('Admin/PostManage')}}",
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