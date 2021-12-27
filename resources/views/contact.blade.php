@extends('layouts.layout')

@section('content')
<section class="content">
    <link rel="stylesheet" href="https://blog.laravel.com/css/theme.css?id=96f52c11ae23e25eced8">

    <div class="container py-4 mx-auto px-4 lg:max-w-screen-sm">
        <h1 class="mb-3">Contact</h1>
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
        <form action="/contact/submit" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" required value="{{old('email')}}">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" required value="{{old('nama')}}">
            </div>
            <div class="mb-4">
                <label for="isi" class="form-label">Isi</label>
                <textarea name="isi" id="isi" cols="30" rows="10" class="form-control" required maxlength="1000">{{old('isi')}}</textarea>
                <div id="the-count">
                    <span id="current">0</span>
                    <span id="maximum">/ 1000</span>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('styles')
<style>
    #the-count {
        float: right;
        padding: 0.1rem 0 0 0;
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script>
    $('textarea').keyup(function() {

        var characterCount = $(this).val().length,
            current = $('#current'),
            maximum = $('#maximum'),
            theCount = $('#the-count');

        current.text(characterCount);


        /*This isn't entirely necessary, just playin around*/
        if (characterCount >= 900) {
            maximum.css('color', '#8f0001');
            current.css('color', '#8f0001');
            theCount.css('font-weight', 'bold');
        }


    });
</script>
@endpush
