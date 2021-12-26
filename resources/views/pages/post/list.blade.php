@extends('layouts.layout')

@section('content')
<div>
    <div class="content-header">
        <div class="container-fluid">
            <h1>List Post</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="w-100">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <table class="table table-hover table-bordered" style="vertical-align: middle;">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;" class="text-center">ID</th>
                            <th scope="col" style="width: 20%;" class="text-center">Judul</th>
                            <th scope="col" style="width: 35%;" class="text-center">Ringkasan</th>
                            <th scope="col" style="width: 20%;" class="text-center">Penulis</th>
                            <th scope="col" style="width: 15%;" class="text-center"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <th scope="row" style="vertical-align: middle;" class="text-center">{{$post->id}}</th>
                            <td style="vertical-align: middle;">{{$post->judul}}</td>
                            <td style="vertical-align: middle;">{{$post->ringkasan}}</td>
                            <td style="vertical-align: middle;">{{$post->user->name}}</td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a class="btn btn-primary" href="{{ route('post.show', ['post' => $post->id]) }}" role="button"><i class="far fa-eye"></i></a>
                                <a class="btn btn-warning" href="{{ route('post.edit', ['post' => $post->id]) }}" role="button"><i class="far fa-edit"></i></a>
                                <button type="button" class="btn btn-float btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" data-action="{{ route('post.delete', ['post' => $post->id]) }}" data-name="{{ $post->judul }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div class="modal fade text-left" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-post" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delete-post">Delete Post</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="post-name-bold"></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <form id="delete-form" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger" onclick="DisableButton(this);">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    td {
        word-wrap: break-word;
        word-break: break-all;
    }
</style>
@endpush
<script>
    function DisableButton(b) {
        b.disabled = true;
        b.form.submit();
    }
</script>
@push('scripts')
<script>
    $('#delete-modal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const action = button.data('action');
        const name = button.data('name');

        $(this).find('#post-name-bold').text(name);
        $(this).find('#delete-form').attr('action', action);
    })
</script>
@endpush
