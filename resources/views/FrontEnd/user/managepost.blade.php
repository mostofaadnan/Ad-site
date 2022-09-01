@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <div class="row">
        <div class="col-sm-2">
            <div class="user_nav">
                @include('FrontEnd.user.userNav')
            </div>
        </div>
        <div class="col-sm-10">
            <section>
                <div class="container table-responsive">
                    <h3 class="info-head my-2">Manage Post</h3>
                    <table class="table table-bordered table-hover responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SL.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Category</th>
                                <th scope="col">City/Location</th>
                                <th scope="col">Posted AT</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            @foreach ($adposts as $post)
                            <?php
$date = $post->created_at;
$postdate = strtotime($date);
$postdate = date('l, d M Y h:i', $postdate);
?>
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td><a href="{{ route('AdDetails', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ $post->status==1?'Active':'Inactive' }}</td>
                                <td>{{ $post->CategoryName->title }}-{{ $post->SubCategoryname->title }}</td>
                                <td>
                                    <?php
if ($post->city_id == 0) {
    $locatoin = 'All City, ' . $post->StateName->name . ',' . $post->CountryName->name;
} else {
    $locatoin = $post->CityName->name . ',' . $post->StateName->name . ',' . $post->CountryName->name;
}?>{{ $locatoin }}</td>
                                <td>{{ $postdate }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('adpost.edit',$post->id ) }}" class="btn btn-sm btn-info"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                                <button class="btn btn-danger deletedata" data-id="{{ $post->id }}"><i class="fa-regular fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="pull-right">{{ $adposts->links() }}</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>
        </div>
    </div>
</main>
<script>
$(document).ready(function() {
    $(".deletedata").on('click', function() {
        if (confirm("Are you sure?")) {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "post",
                url: "{{ url('ManagePost/delete')}}" + '/' + id,
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    console.log(data);
                    alert("Fail To Delete Data")
                    /*  swal("Opps! Faild", "Data Fail to Cancel", "error"); */
                }
            });
        }
        return false;
    })
});
</script>
@endsection