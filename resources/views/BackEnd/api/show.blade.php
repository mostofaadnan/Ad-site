@extends("BackEnd.layouts.app")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Api</h5>
                    </div>
                    <div class="card-body">
                        @include('BackEnd.layouts.ErrorMessage')
                        <h4><a href="http://commerce.coinbase.com/" target="_blank">Get Api</a></h4>
                        <form action="{{ route('api.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="apiname">Api</label>
                                <input type="text" value="Coinbase Api" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="COINBASE_API_KEY">COINBASE API KEY</label>
                                <input type="text" name="apiKey" value="{{ config('coinbase.apiKey') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="COINBASE_API_KEY">Api Version</label>
                                <input type="text" name="apiVersion" value="{{ config('coinbase.apiVersion') }}"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="webhookSecret">Web Hook Secret</label>
                                <input type="text" name="webhookSecret" value="{{ config('coinbase.webhookSecret') }}"
                                    class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
