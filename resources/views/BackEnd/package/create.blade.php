@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-header">New Package</div>
                    <div class="card-body">
                        <div class="container">
                            @include('BackEnd.layouts.ErrorMessage')
                            <form action="{{ route('package.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="title">Package Name</label>
                                    <input type="text" name="package_name" class="form-control"
                                        placeholder="pacage Name">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="postnumber">Total Post</label>
                                    <input type="number" name="post_number" class="form-control"
                                        placeholder="Total Post">
                                    <input class="form-check-input" type="checkbox" name="post_unlimited" value=""
                                        id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Unlimited
                                    </label>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="postnumber">Total Image</label>
                                    <input type="number" name="image_number" class="form-control"
                                        placeholder="Total Post">
                                    <input class="form-check-input" name="image_unlimited" type="checkbox" value=""
                                        id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Unlimited
                                    </label>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="postnumber">Total Day Publish</label>
                                    <input type="number" name="publish_day" class="form-control"
                                        placeholder="Total Post">
                                    <input class="form-check-input" name="publish_unlimited" type="checkbox" value=""
                                        id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Unlimited
                                    </label>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control"
                                        placeholder="Description"></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="price">Price</l1abel>
                                        <input type="number" name="price" class="form-control" placeholder="Price">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="status">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="background_color" class="form-control">
                                        <option value="danger">Red</option>
                                        <option value="primary">Blue</option>
                                        <option value="warning">Yellow</option>
                                    </select>
                                </div>
                                <div class="float-end">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>
@endsection