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
                        Sub-Category Management
                    </div>
                    <div class="float-end">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                            data-bs-target="#subcategorymodel">New Sub-Category</button>
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
                                    <th> Category </th>
                                    <th> Status</th>
                                    <th> Description </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th> #sl </th>
                                    <th> Name </th>
                                    <th> Category </th>
                                    <th> Status</th>
                                    <th> Description </th>
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
@include('BackEnd.modeldata.subcategory')
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- 	<script>
		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		/* $('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		}); */
	</script> -->
<script type='text/javascript'>
var table;
var subcategoryid = 0;

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
            "url": "{{ route('subcategory.loadall') }}",
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
                data: 'category',
                name: 'category',

            },
            {
                data: 'status',
                name: 'status',

            },
            {
                data: 'description',
                name: 'description',

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

$("#subcdatainsert").on("click", function(e) {
    $("#overlay").fadeIn();
    var title = $("#subctitle").val();
    var categoryid = $("#subccategoryid").val();
    var description = $("#subcdescription").val();
    var status = $("#subcstatus").val();
    if (title == "") {
        swal("Opps! Faild", "Title Value Requird", "error");
    } else {
        if (subcategoryid == 0) {
            $.ajax({
                type: 'POST',
                url: "{{ route('subcategory.store') }}",
                data: {
                    title: title,
                    categoryid: categoryid,
                    description: description,
                    status: status
                },
                datatype: ("json"),
                success: function() {
                    $("#overlay").fadeOut();
                    swal("Data Inserted Successfully", "Form Submited", "success");
                    clear();
                    table.ajax.reload();
                },
                error: function() {
                    $("#overlay").fadeOut();
                    swal("Opps! Faild", "Form Submited Faild", "error");

                }

            });
        } else {
            $.ajax({
                type: 'POST',
                url: "{{ route('subcategorys.update') }}",
                data: {
                    id: subcategoryid,
                    title: title,
                    categoryid: categoryid,
                    description: description,
                    status: status
                },
                datatype: ("json"),
                success: function() {
                    $("#overlay").fadeOut();
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
    $("#subcategorymodel").modal('hide');
    $("#subctitle").val("");
    $("#subccategoryid").val("");
    $("#subcdescription").val("");
    $("#subcstatus").val("1");
    subcategoryid = 0;

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
                    url: "{{ url('Admin/Sub-Category/delete')}}" + '/' + dataid,
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
    $("#exampleModalLabel").html("New Sub-Category")
    var id = $(this).data("id");
    $.ajax({
        type: 'get',
        url: "{{ route('subcategory.show') }}",
        data: {
            dataid: id,
        },
        datatype: 'JSON',
        success: function(data) {
            subcategoryid = data.id;
            var status = data.status
            var message = ((status == 0 ? " Deactive " : " Active "));
            $("#subctitle").val(data.title);
            $("#subccategoryid").val(data.category_id);
            /*  $("#categoryid option[value='" + data.category_id + "']").attr('selected',
                 'selected'); */
            if (data.description) {
                $("#subcdescription").val(data.description);
            } else {
                $("#subcdescription").val("");
            }
            $("#subcstatus option[value='" + status + "']").attr('selected', 'selected');
        },
        error: function(data) {

        }
    });
})

$(".model-close").on("click", function() {
    $("#subctitle").val("");
    $("#subccategoryid").val("");
    $("#subcdescription").val("");
    $("#subcstatus").val("1");
    subcategoryid = 0;
    $("#exampleModalLabel").html("New Sub-Category")
});
</script>
@endsection