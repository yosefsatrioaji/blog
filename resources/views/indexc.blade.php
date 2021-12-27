@extends('layouts.layout')

@section('content')
<section class="content">
    <div class="container py-4 mx-auto px-4 lg:max-w-screen-sm">
        <h1>Categories</h1>
        <ul class="category-listing">
            @foreach($categories as $category)
            <li class="category-li"><a style="text-decoration: none;" href="/categories/{{$category->slug}}">{{$category->nama}}<span class="category-count">{{$category->posts->count()}}</span></a></li>
            @endforeach
        </ul>
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

    .category-listing {
        font-size: 1.2rem;
        list-style-type: none;
        text-align: left;
        list-style: disc;
        margin: 0 0 0 0;
        padding: 0;
        display: block;
        margin-block-start: 1rem;
        margin-block-end: 1rem;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 10px;
    }

    .category-count {
        font-size: 1rem;
        color: #50565a;
        margin-left: 5px;
    }

    .category-li {
        background: #f1f1f5;
        display: inline-block;
        margin: 4px;
        padding: 2px 8px;
    }
</style>
@endpush
