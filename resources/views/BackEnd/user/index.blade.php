@extends('BackEnd.layouts.app')
@section('wrapper')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <style .input-group-text{width:auto;}></style>
            <div class="card-header card-header-section">
                <div class="float-start">
                    User List
                </div>
            </div>
            <div class="card-body">
                <table id="mytable" class="data-table table table-striped table-bordered table-sm" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#Sl No</th>
                            <th>Id</th>
                            <th>Name </th>
                            <th>User Name</th>
                            <th>Email </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#Sl No</th>
                            <th>Id</th>
                            <th>Name </th>
                            <th>User Name</th>
                            <th>Email </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function DataTable() {
    var tabledata = $('#mytable').DataTable({
        paging: true,
        scrollY: 500,
        scrollCollapse: false,
        ordering: true,
        searching: true,
        select: true,
        autoFill: true,
        colReorder: true,
        keys: true,
        processing: true,
        serverSide: true,

        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "ajax": {
            "url": "{{ route('userlist.loadall') }}",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },
            {
                data: 'id',
                name: 'id',
                className: "text-center"
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'user_name',
                name: 'user_name',
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    });
}
window.onload = DataTable();
$(document).on('click', '#postlist', function() {
    var id = $(this).data("id");
    url = "{{ url('Admin/UserList/postlist')}}" + '/' + id,
        window.location = url;
});
$(document).on('click', '#userbalancecheck', function() {
    var id = $(this).data("id");
    url = "{{ url('Admin/UserBalanceHistory/userBalanceCheck')}}" + '/' + id,
        window.location = url;
});
$(document).on('click', "#datadelete", function() {
    var logingid = "{{ Auth::user()->id }}"
    var id = $(this).data("id");
    if (logingid == id) {
        swal("Opps! Faild", "Sorry, You Can't Delete it, This is Login User", "error");
    } else {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this  data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "post",
                        url: "{{ url('Admin/User/delete')}}" + '/' + id,
                        success: function() {
                            $('#mytable').DataTable().ajax.reload()
                        },
                        error: function(data) {
                            console.log(data);
                            swal("Opps! Faild", "Data Fail to Delete", "error");
                        }
                    });
                    swal("Ok! Your file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    }
});
</script>
@endsection
