@extends('layouts.layout')

@section('content')
<div>
    <div class="content-header">
        <div class="container-fluid">
            <h1>Contacts</h1>
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
                            <th scope="col" style="width: 20%;" class="text-center">Email</th>
                            <th scope="col" style="width: 20%;" class="text-center">Email Asli</th>
                            <th scope="col" style="width: 15%;" class="text-center">Nama</th>
                            <th scope="col" style="width: 35%;" class="text-center">Isi</th>
                            <th scope="col" style="width: 5%;" class="text-center"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <th scope="row" style="vertical-align: middle;" class="text-center">{{$contact->id}}</th>
                            <td style="vertical-align: middle;">{{$contact->email}}</td>
                            <td style="vertical-align: middle;">{{$contact->actual_email}}</td>
                            <td style="vertical-align: middle;">{{$contact->nama}}</td>
                            <td style="vertical-align: middle;">{{$contact->isi}}</td>
                            <td style="vertical-align: middle;" class="text-center">
                                <button type="button" class="btn btn-float btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" data-action="{{ route('contact.delete', ['contact' => $contact->id]) }}" data-name="{{ $contact->nama }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$contacts->links()}}
        </div>
    </section>
</div>
<div class="modal fade text-left" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-contact" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delete-contact">Delete Contact</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b id="contact-name-bold"></b> contact?</p>
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

        $(this).find('#contact-name-bold').text(name);
        $(this).find('#delete-form').attr('action', action);
    })
</script>
@endpush
