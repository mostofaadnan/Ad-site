@extends('BackEnd.layouts.app')
@section('wrapper')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <style .input-group-text{width:auto;}></style>
            <div class="card-header card-header-section">
                <div class="float-start">
                    Admin User Management
                </div>
                <div class="float-end">
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="First group">
                            <a type="button" class="btn btn-light px-5 radius-30" href="{{Route('admin.create')}}">New
                                User</i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('BackEnd.layouts.ErrorMessage')
                <table id="mytable" class="data-table table table-striped table-bordered table-sm" cellspacing="0">
                    <thead>
                        <tr>
                            <th> #Sl </th>
                            <th>Name</th>
                            <th> Email </th>
                            <th> Status</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th> #Sl </th>
                            <th>Name</th>
                            <th> Email </th>
                            <th> Status</th>
                            <th> Action</th>
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
            "url": "{{ route('admin.loadall') }}",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },
            {
                data: 'name',
                name: 'name',
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
    /*   $('.dataTables_length').addClass('bs-select'); */
}
window.onload = DataTable();
$(document).on('click', '#dataedit', function() {
    var id = $(this).data("id");
    url = "{{ url('Admin/Admin/edit')}}" + '/' + id,
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
                        url: "{{ url('User/delete')}}" + '/' + id,
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