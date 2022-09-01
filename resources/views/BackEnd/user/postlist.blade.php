@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Post List</h4>
            </div>
            <div class="card-body">
                <h6><b>Name:</b> {{ $userinfo->name }}</h6>
                <h6><b>User Name:</b> {{ $userinfo->user_name }}</h6>
                <h6><b>Email:</b> {{ $userinfo->email }}</h6>
                <hr>
                <hr>
                <div class="table-responsive">
                    <table id="mytable" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#Sl No</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#Sl No</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var table;


function DataTable() {
    var user_id = "{{ $userinfo->id }}";
    table = $('#mytable').DataTable({
        responsive: true,
        paging: true,
        scrollY: 400,
        ordering: true,
        searching: true,
        colReorder: true,
        keys: true,
        processing: true,
        serverSide: true,
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: 100,
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row mt-2'<'col-sm-12'tr>>" +
            "<'row mt-2'<'col-sm-6'i><'col-sm-6'p>>",

        "ajax": {
            "url": "{{ url('Admin/UserList/postlist/loadall')}}" + '/' + user_id,
            "type": "GET",
        },

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },

            {
                data: 'date',
                name: 'date',
                className: "text-center"
            },
            {
                data: 'location',
                name: 'location',
            },

            {
                data: 'category',
                name: 'category',
                className: "text-right"
            },
            {
                data: 'subcategory',
                name: 'subcategory',
                className: "text-right"
            },

            {
                data: 'title',
                name: 'title',
                orderable: false,
            },
            {
                data: 'status',
                name: 'status',
                orderable: false,
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

$(document).on('click', '#datashow', function() {
    var id = $(this).data("id");
    url = "{{ url('Admin/PostManage/show')}}" + '/' + id,
        window.location = url;
});
$(document).on('click', '#userbalancecheck', function() {
    var id = $(this).data("id");
    url = "{{ url('Admin/UserBalanceHistory/userBalanceCheck')}}" + '/' + id,
        window.location = url;
});
</script>

@endsection