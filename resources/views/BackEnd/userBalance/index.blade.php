@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User Balance Load</h4>
            </div>
            <div class="card-body">
                <h6><b>Total Top up:</b> {{ $credit }}</h6>
                <h6><b>Total Charge Confirm:</b> {{ $debit }}</h6>
                <h6><b>Account Balance:</b> <span style="color:brown;">{{ $credit }}</span></h6>
                <hr>
                <div class="table-responsive">
                    <table id="mytable" class="table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#Sl No</th>
                                <th>Date</th>
                                <th>User</th>
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
                                <th>User</th>
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


        footerCallback: function() {
            var sum = 0;
            var column = 0;
            this.api().columns('6,7', {
                page: 'current'
            }).every(function() {
                column = this;
                sum = column
                    .data()
                    .reduce(function(a, b) {
                        a = parseFloat(a, 10);
                        if (isNaN(a)) {
                            a = 0;
                        }
                        b = parseFloat(b, 10);
                        if (isNaN(b)) {
                            b = 0;
                        }
                        return (a + b).toFixed(2);
                    }, 0);
                /* if (!sum.includes('€'))
                  sum += ' &euro;'; */
                $(column.footer()).html(sum);

            });
        },

        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-3'i><'col-sm-6 text-center'B><'col-sm-3'p>>",

        buttons: [{
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i>Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    page: 'all',
                },
                footer: true,

            },
            {
                /*  extend: 'pdf', */

                text: '<i class="fa fa-file-pdf-o"></i>PDF',
                extend: 'pdf',
                className: 'btn btn-light',
                orientation: 'landscape', //portrait',
                pageSize: 'A4',
                title: 'Transection List',
                filename: 'Transection',
                className: 'btn btn-danger',
                //download: 'open',
                exportOptions: {
                    /* modifer: {
                      page: 'all',
                    }, */
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    modifier: {
                        page: 'all',
                    }
                },
                footer: true,
                customize: function(doc) {
                    doc.styles.title = {
                        color: 'red',
                        fontSize: '20',
                        // background: 'blue',
                        alignment: 'center'
                    }
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>Print',
                className: 'btn btn-dark',
                title: 'Transection List',
                filename: 'Transection',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    page: 'all',
                },
                footer: true,
            },

        ],

        "ajax": {
            "url": "{{ route('userbalance.loadall') }}",
            "type": "GET",
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
                data: 'user',
                name: 'user',
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
$(document).on('click', '#userbalancecheck', function() {
    var id = $(this).data("id");
    url = "{{ url('Admin/UserBalanceHistory/userBalanceCheck')}}" + '/' + id,
        window.location = url;
});
</script>

@endsection