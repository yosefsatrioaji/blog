@extends('layouts.app-auth')

@section('content')
<main class="form-signin">
    <form action="{{route('signin')}}" method="post">
        @csrf
        <!-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        @if(session()->has('LoginErrors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('LoginErrors')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('signup_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('signup_success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="form-floating">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" required autofocus value="{{old('email')}}">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value=1 name='remember_me'> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <div class="or-container">
            <div class="line-separator"></div>
            <div class="or-label">or</div>
            <div class="line-separator"></div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12"> <a class="btn w-100 btn-lg btn-google btn-outline" href="/auth/redirect"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Sign in using Google</a> </div>
        </div>
        <a href="/forgetpassword">Forgot password?</a>
        <p>
            Need a account? <a href="{{route('register')}}">Sign up</a>
        </p>
    </form>
</main>

@endsection
@push('styles')
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .btn-google {
        color: #545454;
        background-color: #ffffff;
        box-shadow: 0 1px 2px 1px #ddd
    }

    .or-container {
        align-items: center;
        color: #ccc;
        display: flex;
        margin: 25px 0
    }

    .line-separator {
        background-color: #ccc;
        flex-grow: 5;
        height: 1px
    }

    .or-label {
        flex-grow: 1;
        margin: 0 15px;
        text-align: center
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .fa-eye {
        position: absolute;
        top: 20px;
        left: 16px
    }
</style>

@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
<script type="text/javascript">
    $("#password").password('toggle');
</script>
@endpush
