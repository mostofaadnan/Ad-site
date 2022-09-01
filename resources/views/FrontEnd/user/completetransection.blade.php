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
            <section>
                <div class="container table-responsive">
                    <h3 class="info-head my-2" style="color:green">Completed Transaction</h3>
                    <div class="container table-responsive py-5">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <td>{{ $charge['id'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Amount</th>
                                    <td>{{ $charge['pricing']['local']['amount'] }}</td>
                                </tr>
                                <tr>
                                    <th>Network</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Transaction Id</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>
        </div>
    </div>
</main>
@endsection
