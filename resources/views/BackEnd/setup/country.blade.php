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
                        Country Managment
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#countrymodal">New
                            Country</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="mytable" style="width:100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th> #sl </th>
                                    <th> Short Name </th>
                                    <th> Name </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id="showalldata">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> #sl </th>
                                    <th> Short Name </th>
                                    <th> Name </th>
                                    <th> Status </th>
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
@include('BackEnd.modeldata.Country')
<script type='text/javascript'>
var table;
var countryid = 0;

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
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        "ajax": {
            "url": "{{ route('country.loadall') }}",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },
            {
                data: 'sortname',
                name: 'sortname',

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

$("#countrydatainsert").on("click", function(e) {
    $("#overlay").fadeIn();
    var shortname = $("#shortname").val();
    var name = $("#name").val();
    var status = $("#status").val();
    console.log("hello");

    if (name == "") {
        swal("Opps! Faild", "Country Value Requird", "error");
    } else {
        if (countryid == 0) {
            $.ajax({
                type: 'post',
                url: "{{ route('country.store') }}",
                data: {
                    shortname: shortname,
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
                url: "{{ route('country.update') }}",
                data: {
                    id: countryid,
                    shortname: shortname,
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
});

function clear() {
    countryid = 0;
    $("#shortname").val("");
    $("#name").val("");
    $("#status").val("1");
    $("#countrymodal").modal('hide');
}

$(".model-close").on('click', function() {
    countryid = 0;
    $("#shortname").val("");
    $("#name").val("");
    $("#status").val("1");
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
                    type: "post",
                    url: "{{ url('Admin/Country/delete')}}" + '/' + dataid,
                    success: function(data) {
                        console.log(data);
                        table.ajax.reload();
                        clear();
                    },
                    error: function(data) {
                        console.log(data);
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
        url: "{{ route('country.show') }}",
        data: {
            dataid: id,
        },
        datatype: 'JSON',
        success: function(data) {
            clear();
            countryid = data.id;
            var status = data.status
            var message = ((status == 0 ? " Deactive " : " Active "));
            $("#shortname").val(data.sortname);
            $("#name").val(data.name);
            $("#status option[value='" + status + "']").attr('selected', 'selected');
        },
        error: function(data) {

        }
    });
})
</script>

@endsection