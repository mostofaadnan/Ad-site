@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User Balance Load</h4>
            </div>
            <div class="card-body">
                <h6><b>Name:</b> {{ $userinfo->name }}</h6>
                <h6><b>User Name:</b> {{ $userinfo->user_name }}</h6>
                <h6><b>Email:</b> {{ $userinfo->email }}</h6>
                <hr>
                <h6><b>Total Credit:</b> {{ $credit }}</h6>
                <h6><b>Total Debit:</b> {{ $debit }}</h6>
                <h6><b>Balance:</b> {{ $balance }}</h6>
                <hr>
                <div class="table-responsive">
                    <table id="mytable" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#Sl No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Method</th>
                                <th>Transection No</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#Sl No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Method</th>
                                <th>Transection No</th>
                                <th>Credit</th>
                                <th>Debit</th>
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
<script type="text/javascript">
var table;

function DataTable() {

    table = $('#mytable').DataTable({
        responsive: true,
        paging: true,
        scrollY: 450,
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
            "url": "{{ route('userbalance.balancechek.loadall') }}",
            "type": "GET",
            data: {
                'id': "{{  $id }}"
            },
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
                data: 'description',
                name: 'description',
                orderable: false,
            },
            {
                data: 'Method',
                name: 'Method',
                orderable: false,
            },
            {
                data: 'transection',
                name: 'transection',
                orderable: false,
            },
            {
                data: 'credit',
                name: 'credit',
                orderable: false,
            },
            {
                data: 'debit',
                name: 'debit',
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
    url = "{{ url('Admin/UserBalanceHistory/show')}}" + '/' + id,
        window.location = url;
});
</script>

@endsection
