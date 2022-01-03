@extends('layouts.layout')

@section('content')
<section class="content">
    <div class="container py-4 mx-auto px-4 lg:max-w-screen-sm">
        <h1 class="mb-10">{{$nama}}</h1>
        @foreach($category as $post)
        <a href="{{ route('show', ['post' => $post->slug]) }}" class="no-underline transition rounded p-4 post-card border block w-full mb-10">
            <div class="border-0">
                @if($post->cover)
                <div class="block h-post-card-image bg-cover bg-center bg-no-repeat w-full h-48" style="background-image: url({{asset('storage/covers/'.$post->cover)}});">
                </div>
                @endif
                <div class="flex flex-col justify-between flex-1">
                    <h2 class="font-sans leading-normal block mb-6">{{$post->judul}}</h2>
                    <p class="mb-6 leading-normal leading-loose">
                        {{$post->ringkasan}}
                    </p>
                    <div class="flex items-center text-sm">
                        @if($post->user->avatar)
                        <img src="{{asset('storage/profile_pict/'.$post->user->avatar)}}" class="rounded-full w-10 h-10" title="{{$post->user->name}}">
                        @else
                        <img src="{{asset('storage/profile_pict/blank.png')}}" class="rounded-full w-10 h-10" title="{{$post->user->name}}">
                        @endif
                        <span class="ml-2" style="opacity: 0.7;">{{$post->user->name}}</span>
                        <span class="ml-auto" style="opacity: 0.7;">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
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
