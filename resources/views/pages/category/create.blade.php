@extends('layouts.layout')

@section('content')
<div>
    <div class="content-header">
        <div class="container-fluid">
            <h1>Buat Post Baru</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
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
                <div class="">
                    <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kategori" required value="{{old('judul')}}">
                        </div>
                        <button class="btn btn-lg btn-primary mb-3" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    figure.image {
        display: inline-block;
        border: 1px solid gray;
        margin: 0 2px 0 1px;
        background: #f5f2f0;
    }

    figure.align-left {
        float: left;
    }

    figure.align-right {
        float: right;
    }

    figure.image img {
        margin: 8px 8px 0 8px;
    }

    figure.image figcaption {
        margin: 6px 8px 6px 8px;
        text-align: center;
    }


    /*
 Alignment using classes rather than inline styles
 check out the "formats" option
*/

    img.align-left {
        float: left;
    }

    img.align-right {
        float: right;
    }

    /* Basic styles for Table of Contents plugin (toc) */
    .mce-toc {
        border: 1px solid gray;
    }

    .mce-toc h2 {
        margin: 4px;
    }

    .mce-toc li {
        list-style-type: none;
    }
</style>
@endpush
