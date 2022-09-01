@extends("BackEnd.layouts.app")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">

        <div class="dash-wrapper bg-dark">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-5">
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Total User</p>
                            <h3 class="mb-3 text-white" id="totaluser"></h3>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Total Post</p>
                            <h3 class="mb-3 text-white" id="totalpost"></h3>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Post Views</p>
                            <h3 class="mb-3 text-white" id="totalViews"></h3>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Free Post</p>
                            <h3 class="mb-3 text-white" id="freepost"></h3>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Paid Post</p>
                            <h3 class="mb-3 text-white" id="paidpost"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card radius-10 mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-1">Recent Ad Post</h5>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('PostManages') }}" class="btn btn-primary btn-sm radius-30">View All Post</a>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table align-middle mb-0" id="mytable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#Sl No</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Category</th>
                                        <th>Sub-Category</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        type: "Get",
        url: "{{ route('admin.countdata') }}",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $("#totaluser").html(data.totalUser);
            $("#totalpost").html(data.totalPost)
            $('#totalViews').html(data.totalViews);
            $('#freepost').html(data.freepost);
            $('#paidpost').html(data.paidpost);
        },
        error: function() {

        }

    });

});

var table;

function DataTable() {

    table = $('#mytable').DataTable({
        responsive: true,
        paging: true,
        scrollY: 500,
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
            "url": "{{ route('admin.RecentPost') }}",
            "type": "GET",
        },

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },

            {
                data: 'date',
                name: 'date',
                className: "text-center"
            },
            {
                data: 'location',
                name: 'location',
            },

            {
                data: 'category',
                name: 'category',
                className: "text-right"
            },
            {
                data: 'subcategory',
                name: 'subcategory',
                className: "text-right"
            },
            {
                data: 'user',
                name: 'user',
                className: "text-right"
            },
            {
                data: 'title',
                name: 'title',
                orderable: false,
            },
            {
                data: 'status',
                name: 'status',
                orderable: false,
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

window.onload = DataTable();

$(document).on('click', '#datashow', function() {
    var id = $(this).data("id");
    url = "{{ url('Admin/PostManage/show')}}" + '/' + id,
        window.location = url;
});
</script>
@endsection
