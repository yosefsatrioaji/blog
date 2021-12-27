@extends('layouts.layout')

@section('content')
<section class="content">
    <div class="container py-4 mx-auto px-4 lg:max-w-screen-sm">
        <h1 class="mb-4">Edit Profil</h1>
        <div>
            <img src="{{asset('storage/profile_pict/'.$user->avatar)}}" alt="" class="rounded-full w-48 h-48 mx-auto d-block">
            <p class="text-muted text-center mt-3 mb-4">* for now you can only change your profile photo from the chat application</p>
        </div>
        @if(!$user->hasVerifiedEmail())
        <div class="alert alert-danger" role="alert">
            Please verify your email using this <a href="{{ route('email.verif') }}" class="alert-link" onclick="event.preventDefault(); document.getElementById('verif-form').submit();">link</a>
        </div>
        <form id="verif-form" action="{{ route('email.verif') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
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
        <div class="mt-3 mb-3">
            <form action="{{route('profile.user.update')}}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" name="email" required value="{{old('email',$user->email)}}">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" name="nama" required value="{{old('nama',$user->name)}}">
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
        <div class="mt-5 mb-3">
            <form action="{{route('profile.password.update')}}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror" id="password_confirm" placeholder="Confirm Password" required>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">
<style type="text/css">
    /* unvisited link */
    a:link {
        color: #22292f;
    }

    /* visited link */
    a:visited {
        color: #22292f;
    }

    /* mouse over link */
    a:hover {
        color: #22292f;
    }

    /* selected link */
    a:active {
        color: #22292f;
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
