@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Balance Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-striped table-bordered" style="width:100%"
                                cellspacing="0">

                                <tbody>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $userbalance->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>User</th>
                                        <td>{{ $userbalance->UserName->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $userbalance->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Method</th>
                                        <td>{{ $userbalance->Method }}</td>
                                    </tr>
                                    <tr>
                                        <th>Transection No</th>
                                        <td>{{ $userbalance->transection }}</td>
                                    </tr>
                                    <tr>
                                        <th>Credit</th>
                                        <td>{{ $userbalance->credit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Debit</th>
                                        <td>{{ $userbalance->debit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $userbalance->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
