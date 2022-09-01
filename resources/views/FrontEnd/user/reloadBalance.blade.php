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
            <section id="reload-balance">
                <div class="container">
                    <div class="reload-balance-box">
                        <h3 class="info-head">Reload Balance</h3>
                        @include('FrontEnd.layouts.ErrorMessage')
                        <form action="{{ route('user.reloadBalance.store') }}" method="GET">
                            @csrf
                            <label class="fw-bold" for="">Payment Method</label>
                            <select class="form-control" name="currency" aria-label=".form-select-sm example">
                                <option value="USD">USD</option>
                            </select>
                            <label class="fw-bold" for="">Amount In USD*</label>
                            <div class="input-group mb-3">
                                <input type="number" name="amount" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Amount" />
                            </div>
                            <p class="text-dark fw-bold">
                                I have read and agree to this disclaimer as well as the <span class="text-danger">Terms
                                    of
                                    Use.</span>
                            </p>
                            <button class="btn btn-primary" type="submit" value="">Accepts and Submit</button>
                        </form>
                    </div>
                </div>
            </section>
            <div class="container table-responsive py-5">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Method</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created AT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        @foreach($userbalances as $balance)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $balance->Method }}</td>
                            <td>{{ $balance->credit }}</td>
                            <td>{{ $balance->status }}</td>
                            <td>{{ $balance->created_at }}</td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection