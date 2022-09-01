@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="col-lg-12">
            <div class="card mainpanel">
                <div class="card-header card-header-section">
                    <div class="float-left">
                        Menu Management
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#menumodal">New
                            Menu</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="mytable" style="width:100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th> #sl </th>
                                    <th> Name </th>
                                    <th> Menu Type </th>
                                    <th> Page</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> #sl </th>
                                    <th> Name </th>
                                    <th> Menu Type </th>
                                    <th> Page</th>
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
@include('BackEnd.modeldata.menu')
<script type='text/javascript'>
var table;
var menuid = 0;

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

        dom: "<'row'<'col-sm-5'l><'col-sm-7'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        "ajax": {
            "url": "{{ route('menu.loadall') }}",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },
            {
                data: 'menu_title',
                name: 'menu_title',

            },
            {
                data: 'menu_type',
                name: 'menu_type',

            },
            {
                data: 'page',
                name: 'page',

            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },

        ],
    });
}
window.onload = DataTable();

$("#menuinsert").on("click", function(e) {
    $("#overlay").fadeIn();
    var menu_title = $("#menu_title").val();
    var page_id = $("#page_id").val();
    var menutype = $("#menu_types").val();
    console.log(menutype);
    if (menu_title == "" || page_id == "" || menutype=="") {
        swal("Opps! Faild", "Title Value Requird", "error");
    } else {
        if (menuid == 0) {
            $.ajax({
                type: 'POST',
                url: "{{ route('menu.store') }}",
                data: {
                    menu_title: menu_title,
                    page_id: page_id,
                    menu_type: menutype,
                },
                datatype: ("json"),
                success: function(data) {
                    $("#overlay").fadeOut();
                    console.log(data);
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
                type: 'POST',
                url: "{{ route('menu.update') }}",
                data: {
                    id: menuid,
                    menu_title: menu_title,
                    page_id: page_id,
                    menu_type: menutype,
                },
                datatype: ("json"),
                success: function(data) {
                    $("#overlay").fadeOut();
                    console.log(data);
                    swal("Data Inserted Successfully", "Form Submited", "success");
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
    $("#menumodal").modal('hide');
    $("#menu_title").val("");
    $("#page_id").val("");
    $("#menu_types").val("1");
    menuid = 0;

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
                    type: "delete",
                    url: "{{ url('Admin/menu/delete')}}" + '/' + dataid,
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
    $("#exampleModalLabel").html("Edit Menu")
    var id = $(this).data("id");
    $.ajax({
        type: 'get',
        url: "{{ route('menu.show') }}",
        data: {
            dataid: id,
        },
        datatype: 'JSON',
        success: function(data) {
            menuid = data.id;
            $("#menu_title").val(data.menu_title);
            $("#page_id").val(data.page_id);
            $("#menu_types option[value='" + data.menu_type + "']").attr('selected', 'selected');
        },
        error: function(data) {

        }
    });
})

$(".model-close").on("click", function() {
    $("#menu_title").val("");
    $("#page_id").val("");
    $("#menu_types").val("1");
    menuid = 0;
    $("#exampleModalLabel").html("New Menu")
});
</script>
@endsection