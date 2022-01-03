@extends('layouts.app-auth')

@section('content')
<main class="form-signin">
    <form action="{{route('signup')}}" method="post">
        @csrf
        <!-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
        <h1 class="h3 mb-3 fw-normal">Register</h1>
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
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required autofocus value="{{old('email')}}">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name" required value="{{old('name')}}">
            <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <div class="form-floating">
            <input name="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror" id="password_confirm" placeholder="Confirm Password" required>
            <label for="password_confirm">Confirm Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        <div class="or-container">
            <div class="line-separator"></div>
            <div class="or-label">or</div>
            <div class="line-separator"></div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12"> <a class="btn w-100 btn-lg btn-google btn-outline" href="/auth/redirect"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Sign in using Google</a> </div>
        </div>
        <p>Already have an account? <a href="{{route('login')}}">Sign in</a></p>
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

    .form-signin input[name="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[name="name"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .form-signin input[name="password"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .form-signin input[name="password_confirm"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

@endpush

@push('scripts')
<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("password_confirm");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
@endpush
