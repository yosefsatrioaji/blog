@extends('layouts.layout')

@section('content')
<div>
    <div class="content-header">
        <div class="container-fluid">
            <h1>List User</h1>
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
                            <th scope="col" style="width: 20%;" class="text-center">Nama</th>
                            <th scope="col" style="width: 35%;" class="text-center">Email</th>
                            <th scope="col" style="width: 20%;" class="text-center">Last Seen</th>
                            <th scope="col" style="width: 5%;" class="text-center">Verif</th>
                            <th scope="col" style="width: 15%;" class="text-center"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row" style="vertical-align: middle;" class="text-center">{{$user->id}}</th>
                            <td style="vertical-align: middle;">{{$user->name}}</td>
                            <td style="vertical-align: middle;">{{$user->email}}</td>
                            @if($user->last_seen)
                            <td style="vertical-align: middle;">{{\Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}</td>
                            @else
                            <td style="vertical-align: middle;">No Data</td>
                            @endif
                            <td style="vertical-align: middle;">{{$user->verif}}</td>
                            <td style="vertical-align: middle;" class="text-center">
                                @if(!($user->trashed()))
                                <a class="btn btn-warning" href="{{ route('user.edit', ['user' => $user->id]) }}" role="button"><i class="far fa-edit"></i></a>
                                <button type="button" class="btn btn-float btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" data-action="{{ route('user.delete', ['user' => $user->id]) }}" data-name="{{ $user->name }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                @else
                                <button type="button" class="btn btn-float btn-primary" data-bs-toggle="modal" data-bs-target="#restore-modal" data-action="{{ route('user.restore', ['user' => $user->id]) }}" data-name="{{ $user->name }}">
                                    <i class="fas fa-undo"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$users->links()}}
        </div>
    </section>
</div>
<div class="modal fade text-left" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delete-user">Delete User</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="user-name-bold"></b>?</p>
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
<div class="modal fade text-left" id="restore-modal" tabindex="-1" role="dialog" aria-labelledby="restore-user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="restore-user">Restore User</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to restore <b id="user-name-bold"></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <form id="restore-form" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary" onclick="DisableButton(this);">Restore</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">
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

        $(this).find('#user-name-bold').text(name);
        $(this).find('#delete-form').attr('action', action);
    })
    $('#restore-modal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const action = button.data('action');
        const name = button.data('name');

        $(this).find('#user-name-bold').text(name);
        $(this).find('#restore-form').attr('action', action);
    })
</script>
@endpush
