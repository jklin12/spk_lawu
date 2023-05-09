@extends('layouts.default')

@push('css')
<link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama user</th>
                        <th>Email</th>
                        <th>Nomor Telfon</th>
                        <th>Admin</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->is_admin ? 'Ya' :'Tidak'}}</td>
                    <td><button type="button" class="btn btn-warning edit-btn" data-toggle="modal" data-target="#edit-modal" data-route="{{ route('user.update',$user->id)}}" data-name="{{ $user->name}}" data-email="{{ $user->email }}" data-phone="{{ $user->phone}}" data-is_admin="{{ $user->is_admin}}">Edit</button></td>
                    <td><button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal" data-route="{{ route('user.destroy',$user->id) }}" data-nama="{{ $user->name}}">Hapus</button></td>

                </tr>
                @endforeach


                <tbody>


                </tbody>
            </table>
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
                <form action="" method="POST" id="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="admin" name="from" >
                    <div class="form-group">
                        <label for="inputNama">Nama </label>
                        <input type="text" class="form-control" id="inputName" placeholder="" name="name" value="{{ old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputNama">Email </label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="" name="email" value="{{ old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputNama">No Telpon </label>
                        <input type="text" class="form-control" id="inputPhone" placeholder="" name="phone" value="{{ old('phone')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputNama">Admin </label>
                        <select class="form-control" id="inputAdmin" name="is_admin">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin menghapus <strong id="delete-name"></strong></div>
            <form action="" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
            </form>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger" form="delete-form" type="submit">Ya</button>
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


        $('#dataTable').DataTable();


        $('.delete-btn').click(function() {

            $('#delete-name').html($(this).data('nama'))
            $('#delete-form').attr('action', $(this).data('route'))
        })


        $('.edit-btn').click(function() {
            $('#edit-form').attr('action', $(this).data('route'))
            $('#edit-form #inputName').val($(this).data('name'))
            $('#edit-form #inputEmail').val($(this).data('email'))
            $('#edit-form #inputPhone').val($(this).data('phone'))
            $('#edit-form #inputAdmin').val($(this).data('is_admin')).change()
        })
    })
</script>

@endpush