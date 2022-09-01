@extends('BackEnd.layouts.app')
@section('wrapper')

<div class="page-wrapper">
    <div class="page-content">

        <style>
        .card {
            border: 1px #ccc solid;

        }

        .mainpanel {
            border: none;
        }
        </style>

        <div class="col-lg-12">
            <div class="card mainpanel">
                <div class="card-header card-header-section">
                    <div class="float-left">
                        Report Option Managment
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#reportoptionmodal">New
                            Report Option</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="mytable" style="width:100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#sl </th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="showalldata">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#sl </th>
                                    <th>Name</th>
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

    @include('BackEnd.modeldata.reportoption')
    <script type='text/javascript'>
    var table;
    var reportoptionid = 0;



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

            //dom: 'lBfrtip',
            dom: "<'row'<'col-sm-5'l><'col-sm-7'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "ajax": {
                "url": "{{ route('reportoption.loadall') }}",
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
                    data: 'status',
                    name: 'status',

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
        });
        $('.dataTables_length').addClass('bs-select');
    }
    window.onload = DataTable();

    $("#reportdatainsert").on("click", function(e) {
        $("#overlay").fadeIn();

        var name = $("#name").val();
        var status = $("#status").val();
        if (name == "") {
            swal("Opps! Faild", "Title Value Requird", "error");
        } else {
            if (reportoptionid == 0) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('reportoption.store') }}",
                    data: {

                        name: name,
                        status: status
                    },
                    datatype: ("json"),
                    success: function(data) {
                        $("#overlay").fadeOut();
                        swal("Data Inserted Successfully", "Form Submited", "success");
                        clear();
                        table.ajax.reload();
                    },
                    error: function(data) {
                        $("#overlay").fadeOut();
                        swal("Opps! Faild", "Form Submited Faild", "error");
                        console.log(data);
                    }
                });
            } else {
                $.ajax({
                    type: 'post',
                    url: "{{ route('reportoption.update') }}",
                    data: {
                        id: reportoptionid,
                        name: name,
                        status: status
                    },
                    datatype: ("json"),
                    success: function() {
                        $("#overlay").fadeOut();
                        swal("Data Update Successfully", "Form Submited", "success");
                        clear();
                        table.ajax.reload();

                    },
                    error: function() {
                        $("#overlay").fadeOut();
                        swal("Opps! Faild", "Form Submited Faild", "error");

                    }

                });

            }
        }
    })

    function clear() {
        reportoptionid = 0;
        $("#name").val("");
        $("#status").val("1");
        $('#reportoptionmodal').modal('hide');
    }
    $(document).on('click', "#reset", function() {
        clear();
    })
    $(document).on('click', '#deletedata', function() {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this  data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var dataid = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "{{ url('Admin/ReportOption/delete')}}" + '/' + dataid,
                        success: function(data) {
                            table.ajax.reload();
                            clear();
                        },
                        error: function() {
                            swal("Opps! Faild", "Form Submited Faild", "error");

                        }
                    });
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });


    })
    //show Data by id

    $(document).on('click', '#datashow', function() {
        var id = $(this).data("id");
        $("#exampleModalLabel").html("Edit Report Option")
        $.ajax({
            type: 'get',
            url: "{{ route('reportoption.show') }}",
            data: {
                dataid: id,
            },
            datatype: 'JSON',
            success: function(data) {
                featureid = data.id;
                var status = data.status
                var message = ((status == 0 ? " Deactive " : " Active "));
                $("#name").val(data.name);
                $("#status option[value='" + status + "']").attr('selected', 'selected');
            },
            error: function(data) {

            }
        });
    })
    $(".model-close").on("click", function() {
        reportoptionid = 0;
        $("#name").val("");
        $("#status").val("1");
        $("#exampleModalLabel").html("New Report Option")
    });
    </script>

    @endsection
