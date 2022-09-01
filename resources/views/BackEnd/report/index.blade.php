@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Post Report Collection</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-striped table-bordered" style="width:100%" cellspacing="0">

                        <thead class="table-light">
                            <tr>
                                <th>#Sl No</th>
                                <th>Date</th>
                                <th>Post Title</th>
                                <th>User</th>
                                <th>Report Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#Sl No</th>
                                <th>Date</th>
                                <th>Post Title</th>
                                <th>User</th>
                                <th>Report Type</th>
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
            "url": "{{ route('AdReport.loadall') }}",
            "type": "GET",
        },

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },

            {
                data: 'created_at',
                name: 'created_at',
                className: "text-center"
            },
            {
                data: 'post_title',
                name: 'post_title',
            },

            {
                data: 'user',
                name: 'user',
                className: "text-right"
            },
            {
                data: 'report_option',
                name: 'report_option',
                className: "text-right"
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
$(document).ready(function() {
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[2]);
            if (min == null && max == null) {
                return true;
            }
            if (min == null && startDate <= max) {
                return true;
            }
            if (max == null && startDate >= min) {
                return true;
            }
            if (startDate <= max && startDate >= min) {
                return true;
            }
            return false;
        }
    );

    window.onload = DataTable();

    $(document).on('click', '#datashow', function() {
        var id = $(this).data("id");
        url = "{{ url('Admin/AdReports/show')}}" + '/' + id,
            window.location = url;
    });

    $(document).on('click', '#postdetails', function() {
        var id = $(this).data("id");
        url = "{{ url('Admin/PostManages/show')}}" + '/' + id,
            window.location = url;
    });

    $(document).on('click', '#delete', function() {
        swal({
                title: "Are you sure?",
                text: "Once Delete, you will not be able to recover this  data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data("id");
                    $.ajax({
                        type: "delete",
                        url: "{{ url('Admin/AdReports/delete')}}" + '/' + id,
                        success: function(data) {
                            $('#mytable').DataTable().ajax.reload()
                        },
                        error: function(data) {
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

});
</script>

@endsection
