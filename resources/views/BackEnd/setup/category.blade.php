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
                        Category Management
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#categorymodel">New
                            Category</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="mytable" style="width:100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#sl </th>
                                    <th>Name </th>
                                    <th>Post Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="showalldata">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#sl </th>
                                    <th>Name </th>
                                    <th>Post Type</th>
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

    @include('BackEnd.modeldata.category')
    <script type='text/javascript'>
    var table;
    var categoryid = 0;


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
                "url": "{{ route('category.loadall') }}",
                "type": "GET",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: "text-center"
                },
                {
                    data: 'title',
                    name: 'title',

                },
                {
                    data: 'post_type',
                    name: 'post_type',

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
    var sl = 1;
    $("#post_type").on('change', function() {
        var value = $(this).val();
        if (value == 1) {
            $(".custom-field").hide();
            $("#field_label").val("");
            $("#field_name").val("");
            $("#field_type").val("text");
            $("#tablebody").empty();
        } else {
            $(".custom-field").show();
        }

    });

    $("#add_btn").on('click', function() {
        var field_label = $("#field_label").val();
        var field_name = $("#field_name").val();
        var field_type = $("#field_type").val();

        var isvalid = true;
        $(".data-table TBODY TR").each(function() {
            var row = $(this);
            var name = row.find("TD").eq(1).html();
            if (field_name == name) {
                isvalid = false;
                var findrow = $(this);
                alert('already Exits');
            }
        });
        if (isvalid == true) {
            $(".data-table tbody").append("<tr>" +
                "<td align='center'>" + sl + "</td>" +
                "<td>" + field_label + "</td>" +
                "<td>" + field_name + "</td>" +
                "<td>" + field_type + "</td>" +
                "<td>" +
                " <div class='btn-group' role='group' aria-label='Basic example'>" +
                "<button class='btn btn-danger btn-sm btn-delete'>X</button>" +
                "<div>" +
                "</td>" +
                "</tr>");
            sl++;
            $("#field_label").val("");
            $("#field_name").val("");
            $("#field_type").val("text");
        }
    });


    $("body").on("click", ".btn-delete", function() {
        $(this).parents("tr").remove();
    });
    $("#categorydatainsert").on("click", function(e) {
        $("#overlay").fadeIn();
        var title = $("#categorytitle").val();
        var status = $("#categorystatus").val();
        var post_type = $("#post_type").val();
        var total_free_post = $("#total_free_post").val();
        var per_post_charge = $("#per_post_charge").val();
        var free_post_publish_day = $("#free_post_publish_day").val();
        var premimum_publish_day = $("#premimum_publish_day").val();
        var adult_content = $("#adult_content").val();
        var itemtables = new Array();
        $(".data-table TBODY TR").each(function() {
            var row = $(this);
            var item = {};

            item.field_label = row.find("TD").eq(1).html();
            item.field_name = row.find("TD").eq(2).html();
            item.field_type = row.find("TD").eq(3).html();
            if (post_type == 2) {
                itemtables.push(item);
            }
        });

        if (title == "") {
            swal("Opps! Faild", "Title Value Requird", "error");
        } else {
            if (categoryid == 0) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('category.store') }}",
                    data: {
                        title: title,
                        post_type: post_type,
                        total_free_post: total_free_post,
                        per_post_charge: per_post_charge,
                        free_post_publish_day: free_post_publish_day,
                        premimum_publish_day: premimum_publish_day,
                        adult_content:adult_content,
                        status: status,
                        itemtables: itemtables
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
                    url: "{{ route('category.update') }}",
                    data: {
                        id: categoryid,
                        title: title,
                        post_type: post_type,
                        total_free_post: total_free_post,
                        per_post_charge: per_post_charge,
                        free_post_publish_day: free_post_publish_day,
                        premimum_publish_day: premimum_publish_day,
                        adult_content:adult_content,
                        status: status,
                        itemtables: itemtables
                    },
                    datatype: ("json"),
                    success: function() {
                        $("#overlay").fadeOut();
                        swal("Data Update Successfully", "Form Submited", "success");
                        clear();
                        table.ajax.reload();

                    },
                    error: function(data) {
                        console.log(data);
                        $("#overlay").fadeOut();
                        swal("Opps! Faild", "Form Submited Faild", "error");
                    }
                });

            }
        }
    })

    function clear() {
        categoryid = 0;
        $("#categorytitle").val("");
        $("#categorystatus").val("1");
        $('#categorymodel').modal('hide');
        $("#post_type").val(1);
        $("#total_free_post").val("");
        $("#per_post_charge").val("");
        $("#free_post_publish_day").val("");
        $("#premimum_publish_day").val("");
        $("#adult_content").val("0")
        $("#tablebody").empty();
        $(".custom-field").hide();
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
                        url: "{{ url('Admin/Category/delete')}}" + '/' + dataid,
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
        $("#exampleModalLabel").html("Edit Category")
        $.ajax({
            type: 'get',
            url: "{{ route('category.show') }}",
            data: {
                dataid: id,
            },
            datatype: 'JSON',
            success: function(data) {
                console.log(data.post_type);
                categoryid = data.id;
                var status = data.status
                /*  var message = ((status == 0 ? " Deactive " : " Active ")); */
                $("#categorytitle").val(data.title);
                $("#total_free_post").val(data.total_free_post);
                $("#free_post_publish_day").val(data.free_post_publish_day);
                $("#per_post_charge").val(data.per_post_charge);
                $("#premimum_publish_day").val(data.premimum_publish_day);
                $("#post_type").val(data.post_field_type);
                $("#adult_content").val(data.adult_content);
                $("#categorystatus option[value='" + status + "']").attr('selected', 'selected');
                /* $("#adult_content option[value='" + data.adult_content + "']").attr('selected', 'selected'); */
                if (data.post_field_type == 2) {
                    $("#tablebody").empty();
                    $(".custom-field").show();
                    PostFieldDetaills(data);
                } else {
                    $("#tablebody").empty();
                    $(".custom-field").hide();
                }
            },
            error: function(data) {

            }
        });
    });

    function PostFieldDetaills(data) {
        var sl = 1;
        data.post_type.forEach(function(value) {
            $(".data-table tbody").append("<tr>" +
                "<td>" + sl + "</td>" +
                "<td class='itemname'>" + value.field_label + "</td>" +
                "<td class='itemname'>" + value.field_name + "</td>" +
                "<td align='right'>" + value.field_type + "</td>" +
                "<td>" +
                " <div class='btn-group' role='group' aria-label='Basic example'>" +
                "<button class='btn btn-danger btn-sm btn-delete'>X</button>" +
                "<div>" +
                "</td>" +
                "</tr>");
            sl++;
        })
    }
    $(".model-close").on("click", function() {
        categoryid = 0;
        $("#categorytitle").val("");
        $("#categorystatus").val("1");
        $("#post_type").val(1);
        $("#total_free_post").val("");
        $("#per_post_charge").val("");
        $("#free_post_publish_day").val("");
        $("#premimum_publish_day").val("");
        $("#tablebody").empty();
        $(".custom-field").hide();
        $("#exampleModalLabel").html("New Category");
        $("#adult_content").val("0")
    });
    </script>



    @endsection