@extends('layouts.layout')

@section('content')
<section class="content">

    <div class="container py-4 mx-auto px-4 lg:max-w-screen-sm">
        <h1 class="mb-2">{{$post->judul}}</h1>
        <div class="flex items-center text-smt" style="opacity: 0.7;">
            <span>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
            —
            <a href="/categories/{{$post->category->slug}}" class="text-muted">{{$post->category->nama}}</a>
        </div>
        <div class="mt-3 leading-loose flex flex-col justify-center items-center post-body">
            @if($post->cover)
            <p>
                <img src="{{asset('storage/covers/'.$post->cover)}}" alt="">
            </p>
            @endif
            {!! $post->isi !!}
        </div>
        <div class="mt-1 lg:flex items-center p-4 border border-lighter  rounded">
            <div class="w-full lg:w-1/6 w-5 text-center lg:text-left">
                @if($post->user->avatar)
                <img src="{{asset('storage/profile_pict/'.$post->user->avatar)}}" class="rounded-full w-32 lg:w-full">
                @else
                <img src="{{asset('storage/profile_pict/blank.png')}}" class="rounded-full w-32 lg:w-full">
                @endif
            </div>
            <div class="lg:pl-5 leading-loose lg:text-left text-text-color w-full lg:w-5/6">
                By <span class="font-bold">{{$post->user->name}}
                    @if($post->user->verif == 1)
                    <svg style="margin-bottom: 2px;" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0L9.99182 1.3121L12.3696 1.29622L13.3431 3.48797L15.3519 4.77336L14.9979 7.14888L16 9.32743L14.431 11.1325L14.1082 13.5126L11.8223 14.1741L10.277 16L8 15.308L5.72296 16L4.17772 14.1741L1.89183 13.5126L1.569 11.1325L0 9.32743L1.00206 7.14888L0.648112 4.77336L2.65693 3.48797L3.6304 1.29622L6.00818 1.3121L8 0Z" fill="#0095F6"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4036 5.20536L7.18853 8.61884L6.12875 7.49364C5.8814 7.23102 5.46798 7.21864 5.20536 7.466C4.94274 7.71335 4.93036 8.12677 5.17771 8.38939L6.71301 10.0195C6.9709 10.2933 7.40616 10.2933 7.66405 10.0195L11.3546 6.10111C11.6019 5.83848 11.5896 5.42507 11.3269 5.17771C11.0643 4.93036 10.6509 4.94274 10.4036 5.20536Z" fill="white"></path>
                    </svg>
                    @endif</span>
                <div class="text-sm">
                    <p>{{$post->user->summary}}</p><a href="/authors/{{$post->user->slug}}">Author's profile</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
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
@endpush
