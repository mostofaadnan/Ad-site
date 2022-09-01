@extends('BackEnd.layouts.app')
@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        User Reload Balance
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" value="{{ $userinfo->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" value="{{ $userinfo->email }}" disabled>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="name">Total Credit</label>
                            <input type="text" class="form-control" value="{{ $credit }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Total Debit</label>
                            <input type="text" class="form-control" value="{{ $debit }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Current Balance</label>
                            <input type="text" class="form-control" value="{{ $balance }}" disabled>
                        </div>

                        <form action="{{ route('userlist.userReloadBalance.reloadStore') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="$userinfo->id">
                            <div class="form-group">
                                <label for="name">Amount</label>
                                <input type="number" class="form-control" name="credit" placeholder="amount">
                            </div>
                            <div class="form-group">
                                <label for="name">Payment Description</label>
                                <input type="text" class="form-control" name="payment_description"
                                    placeholder="Payment Description">
                            </div>

                            <div class="form-group">
                                <label for="name">Transection Number</label>
                                <input type="text" class="form-control" name="transection"
                                    placeholder="Transection Number">
                            </div>
                            <div class="form-group">
                                <label for="name">currency</label>
                                <select name="currency" id="" class="form-control">
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Method</label>
                                <select name="currency" id="" class="form-control">
                                    <option value="Coin">Coin</option>
                                    <option value="Card">Card</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Sumit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
