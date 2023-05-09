@extends('layouts.default')

@push('css')
<link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    
    <div class="card shadow mb-4">

        <div class="card-body">
            <p>Email : {{ $user->email}}</p>
            <p>Nama : {{ $user->name}}</p>
            <p>No Telpon : {{ $user->phone}}</p>
            <p>Password : ***********</p>
            <!-- Circle Buttons (Default) -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-modal">Edit Data</button>

        </div>
    </div>
</div>
 

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Edit User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update' ,$user->id)}}" method="POST" id="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="user" name="from" >
                    <div class="form-group">
                        <label for="inputNama">Nama </label>
                        <input type="text" class="form-control" id="inputName" placeholder="" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="inputNama">Email </label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="inputNama">No Telpon </label>
                        <input type="text" class="form-control" id="inputPhone" placeholder="" name="phone" value="{{ $user->phone }}">
                    </div> 
                    <div class="form-group">
                        <label for="inputJumlah">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="" name="password" value="{{ old('password')}}">
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" form="edit-form" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ URL::asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->

<script>
    $(document).ready(function() {
        $('#nav-user').addClass('active')


       
    })
</script>

@endpush