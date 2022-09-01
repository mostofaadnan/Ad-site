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
                        City Management
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#citymodal">New
                            City</button>
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
                                  <!--   <th> State </th>
                                    <th> Country</th> -->
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id="showalldata">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> #Sl </th>
                                    <th> Name </th>
                              <!--       <th> State </th>
                                    <th> Country</th> -->
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
@include('BackEnd.modeldata.City')
<script type='text/javascript'>
$('#country').change(function() {
    var countryID = $(this).val();
    if (countryID) {
        $.ajax({
            type: "GET",
            url: "{{url('Admin/State/get-state-list')}}?country_id=" + countryID,
            success: function(res) {
                if (res) {
                    $("#state_id").empty();
                    $("#state_id").append('<option value="">Select</option>');
                    $.each(res, function(key, value) {
                        $("#state_id").append('<option value="' + key + '">' +
                            value + '</option>');
                    });
                } else {
                    $("#state_id").empty();
                }
            }
        });
    } else {
        $("#state_id").empty();
        $("#name").val("");
    }
});

var table;
var cityid = 0;
var state_ids = 0;


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
            "url": "{{ route('city.loadall') }}",
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
   /*          {
                data: 'state',
                name: 'state',

            },
            {
                data: 'country',
                name: 'country',

            }, */

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

$("#citydatainsert").on("click", function(e) {
    $("#overlay").fadeIn();

    var name = $("#name").val();
    var state_id = $("#state_id").val();
    if (name == "" || state_id == "") {
        swal("Opps! Faild", "Country Value Requird", "error");
    } else {
        if (cityid == 0) {
            $.ajax({
                type: 'post',
                url: "{{ route('city.store') }}",
                data: {

                    name: name,
                    state_id: state_id,

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
                url: "{{ route('city.update') }}",
                data: {
                    id: cityid,
                    name: name,
                    state_id: state_ids,
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
    cityid = 0;
    state_ids = 0;
    $("#country").val($("#country_id option:first").val());
    $("#name").val("");
    $("#state_id").empty();
    $("#citymodal").modal("hide");
}
$(".model-close").on('click', function() {
    cityid = 0;
    state_ids = 0;
    $("#country").val($("#country_id option:first").val());
    $("#name").val("");
    $("#state_id").empty();

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
                    url: "{{ url('Admin/City/delete')}}" + '/' + dataid,
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
        url: "{{ route('city.show') }}",
        data: {
            dataid: id,
        },
        datatype: 'JSON',
        success: function(data) {
            clear();
            cityid = data.id;
            state_ids = data.state_id;
            statechange(data.state_name.country_name['id'], data.state_id)
            $("#name").val(data.name);

        },
        error: function(data) {

        }
    });
})

function statechange(countryID, state_id) {

    if (countryID) {
        $.ajax({
            type: "GET",
            url: "{{url('Admin/State/get-state-list')}}?country_id=" + countryID,
            success: function(res) {
                if (res) {
                    $("#state_id").empty();
                    $("#state_id").append('<option value="">Select</option>');
                    $.each(res, function(key, value) {
                        $("#state_id").append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    $("#country option[value='" + countryID + "']").attr('selected', 'selected');
                    $("#state_id option[value='" + state_id + "']").attr('selected', 'selected');
                } else {
                    $("#state_id").empty();
                }
            }
        });
    } else {
        $("#state_id").empty();
        $("#name").val("");
    }

}

$(document).on('click', '#inactive', function() {
    var id = $(this).data("id");
    $.ajax({
        type: "get",
        url: "{{ url('Admin/City/inactive')}}" + '/' + id,
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
        url: "{{ url('Admin/City/active')}}" + '/' + id,
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