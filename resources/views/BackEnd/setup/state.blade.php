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
                        State Management
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#statemodal">New
                            State</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="mytable" style="width:100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th> #Sl </th>
                                    <th> Name </th>
                                    <th> Country</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id="showalldata">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> #Sl) </th>
                                    <th> Name </th>
                                    <th> Country</th>
                                    <th> Action </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('BackEnd.modeldata.State')
<script type='text/javascript'>
var table;
var stateid = 0;

function DataTable() {
    table = $('#mytable').DataTable({
        responsive: true,
        paging: true,
        scrollY: 500,
        ordering: true,
        searching: true,
        colReorder: true,
        keys: true,
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: 100,
        processing: true,
        serverSide: true,

        //dom: 'lBfrtip',
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        "ajax": {
            "url": "{{ route('state.loadall') }}",
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
                data: 'country',
                name: 'country',

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

$("#statedatainsert").on("click", function(e) {
    $("#overlay").fadeIn();

    var name = $("#name").val();
    var country_id = $("#country_id").val();
    if (name == "") {
        swal("Opps! Faild", "Country Value Requird", "error");
    } else {
        if (stateid == 0) {
            $.ajax({
                type: 'post',
                url: "{{ route('state.store') }}",
                data: {

                    name: name,
                    country_id: country_id,

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
                url: "{{ route('state.update') }}",
                data: {
                    id: stateid,
                    name: name,
                    country_id: country_id,

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
    stateid = 0;
    $("#country_id").val($("#country_id option:first").val());
    $("#name").val("");
    $("#statemodal").modal('hide');
}
$(".model-close").on('click', function() {
    stateid = 0;
    $("#country_id").val($("#country_id option:first").val());
    $("#name").val("");

});
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
                    type: "POST",
                    url: "{{ url('Admin/State/delete')}}" + '/' + dataid,
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
    $.ajax({
        type: 'get',
        url: "{{ route('state.show') }}",
        data: {
            dataid: id,
        },
        datatype: 'JSON',
        success: function(data) {
            stateid = data.id;
            $("#name").val(data.name);

            $("#country_id option[value='" + data.country_id + "']").attr('selected',
                'selected');
        },
        error: function(data) {

        }
    });
})

$(document).on('click', '#inactive', function() {
    var id = $(this).data("id");
    $.ajax({
        type: "get",
        url: "{{ url('Admin/State/inactive')}}" + '/' + id,
        success: function(data) {
            table.ajax.reload(); 
        },
        error: function(data) {
            console.log(data);
            swal("Opps! Faild", "Data Fail to Cancel", "error");
        }
    });

});
$(document).on('click', '#active', function() {
    var id = $(this).data("id");
    $.ajax({
        type: "get",
        url: "{{ url('Admin/State/active')}}" + '/' + id,
        success: function(data) {
            table.ajax.reload(); 
        },
        error: function(data) {
            console.log(data);
            swal("Opps! Faild", "Data Fail to Cancel", "error");
        }
    });

});
</script>

@endsection