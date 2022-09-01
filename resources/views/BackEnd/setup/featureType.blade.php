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
                        Ad Feature Managment
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#featuremodal">New
                            Feature</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="mytable" style="width:100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#sl </th>
                                    <th>Day</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="showalldata">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#sl </th>
                                    <th>Day</th>
                                    <th>Amount</th>
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

    @include('BackEnd.modeldata.featuretype')
    <script type='text/javascript'>
    var table;
    var featureid = 0;



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
                "url": "{{ route('feature.loadall') }}",
                "type": "GET",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: "text-center"
                },
                {
                    data: 'total_day',
                    name: 'total_day',

                },
                {
                    data: 'amount',
                    name: 'amount',

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

    $("#featuredatainsert").on("click", function(e) {
        $("#overlay").fadeIn();
        var total_day = $("#total_day").val();
        var amount = $("#amount").val();
        var status = $("#status").val();
        var method = $(this).attr("method");
        if (total_day == "" && amount=="") {
            swal("Opps! Faild", "Title Value Requird", "error");
        } else {
            if (featureid == 0) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('feature.store') }}",
                    data: {
                        total_day: total_day,
                        amount: amount,
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
                    url: "{{ route('feature.update') }}",
                    data: {
                        id: featureid,
                        total_day: total_day,
                        amount: amount,
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
        categoryid = 0;
        $("#total_day").val("");
        $("#amount").val("");
        $("#status").val("1");
        $('#featuremodal').modal('hide');
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
                        url: "{{ url('Admin/Feature/delete')}}" + '/' + dataid,
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
        $("#exampleModalLabel").html("Edit Feature")
        $.ajax({
            type: 'get',
            url: "{{ route('feature.show') }}",
            data: {
                dataid: id,
            },
            datatype: 'JSON',
            success: function(data) {
                featureid = data.id;
                var status = data.status
                var message = ((status == 0 ? " Deactive " : " Active "));
                $("#total_day").val(data.total_day);
                $("#amount").val(data.amount);
                $("#status option[value='" + status + "']").attr('selected', 'selected');
            },
            error: function(data) {

            }
        });
    })
    $(".model-close").on("click", function() {
        featureid = 0;
        $("#total_day").val("");
        $("#amount").val("");
        $("#status").val("1");
        $("#exampleModalLabel").html("New Feature")
    });
    </script>

    @endsection