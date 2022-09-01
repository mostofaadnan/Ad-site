@extends('FrontEnd.layouts.master')
@section('content')
<main>
    <div class="row">
        <div class="col-sm-2">
            <div class="user_nav">
                @include('FrontEnd.user.userNav')
            </div>
        </div>
        <div class="col-sm-10">
            <div class="user-main">
                <section class="counting-post">
                    <div class="container">
                        <h3 class="info-head">Post Details</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="counter-box text-center">
                                    <p class="counter">0</p>
                                    <p class="counter-name">Active Post</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="counter-box text-center">
                                    <p class="counter">{{ $paid_post }}</p>
                                    <p class="counter-name">Paid Posts</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="counter-box text-center">
                                    <p class="counter">{{ $free_post }}</p>
                                    <p class="counter-name">Free Post</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="user-info">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="info-head">Account Details</h3>
                                        <table class="table">
                                            <tr>
                                                <th class="text-dark fw-bold">Name :</th>
                                                <td class="text-dark"> {{ Auth::user()->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-bold">Email :</td>
                                                <td class="text-dark"> {{ Auth::user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-bold">Username :</td>
                                                <td class="text-dark">{{ Auth::user()->user_name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div cla
                                ss="row">
                                    <div class="col-sm-12">
                                        <h3 class="info-head">Billing & Balance</h3>
                                        <table class="table">
                                            <tr>
                                                <th class="text-dark fw-bold">Account Balance : </th>
                                                <td class="text-dark fw-bold">${{ $userBalance }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-bold">Confirmed Charges : </td>
                                                <td class="text-dark">0</td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-bold">Pending Charges : </td>
                                                <td class="text-dark">0</td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-bold">Total Charge Created : </td>
                                                <td class="text-dark">0</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

</main>
@endsection