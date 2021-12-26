@extends('layouts.layout')

@section('content')
<section class="content">
    <link rel="stylesheet" href="https://blog.laravel.com/css/theme.css?id=96f52c11ae23e25eced8">
    <style>
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

    <div class="container py-4 mx-auto px-4 lg:max-w-screen-sm">
        <h1 class="mb-2">{{$post->judul}}</h1>
        <div class="flex items-center text-smt" style="opacity: 0.7;">
            <span>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
            —
            <a href="#" class="text-muted">kategori</a>
        </div>
        <div class="mt-3 leading-loose flex flex-col justify-center items-center post-body">
            <img src="{{asset('storage/covers/'.$post->cover)}}" alt="">
            {!! $post->isi !!}
        </div>
        <div class="mt-1 lg:flex items-center p-4 border border-lighter  rounded">
            <div class="w-full lg:w-1/6 w-5 text-center lg:text-left">
                <img src="{{asset('assets/img/profile_pict/'.$post->user->profile_pict)}}" class="rounded-full w-32 lg:w-full">
            </div>
            <div class="lg:pl-5 leading-loose lg:text-left text-text-color w-full lg:w-5/6">
                By <span class="font-bold">{{$post->user->name}}</span>
                <div class="text-sm">
                    <p>{{$post->user->summary}}</p><a href="#">Author's profile</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
@endpush
