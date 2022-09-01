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

                    <h3 class="info-head my-2">Edit Information</h3>
                    @include('FrontEnd.layouts.ErrorMessage')
                    <form action="{{ route('user.Update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" name="user_name" placeholder="User Name" class="form-control"
                                value="{{ Auth::user()->user_name }}" required>
                        </div>
                        <div class="from-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control"
                                value="{{ Auth::user()->name  }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="email" class="form-control"
                                value="{{ Auth::user()->email  }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Paword</label>
                            <input type="password" name="password" placeholder="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm passwor">Confirm Passwor</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirm Password">
                        </div>
                        <button class="btn btn-primary" type="submit" value="">Save</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
