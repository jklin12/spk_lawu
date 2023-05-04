@extends('layouts.default')

@push('css')
<link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Detail Pendakian</h1>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">

        <div class="card-body">
            <p>Nama Kelompok : {{ $pendakian->nama_kelompok}}</p>
            <p>Tanggal Berangkat : {{ $pendakian->tanggal_berangkat}}</p>
            <p>Tanggal Pulang : {{ $pendakian->tanggal_pulang}}</p>
            <p>Jumlah Anggota : {{ $pendakian->jumlah_anggota}} Orang</p>
            @php
            $badgeColor = '';
            if($pendakian->status == 'pengajuan'){
            $badgeColor = 'primary';
            }elseif($pendakian->status == 'diterima'){
            $badgeColor = 'success';
            }elseif($pendakian->status == 'pengajuan_ulang'){
            $badgeColor = 'warning';
            }elseif($pendakian->status == 'ditolak'){
            $badgeColor = 'danger';
            }
            @endphp
            <p>Status : <span class="badge badge-{{$badgeColor}}">{{ $pendakian->status}}</span></p>
            <!-- Circle Buttons (Default) -->

        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6>Data Anggota</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>No Telepon</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($anggotas as $key => $anggota)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $anggota->nama_anggota}}</td>
                        <td>{{ $anggota->alamat_anggota}}</td>
                        <td>{{ $anggota->jenis_kelamin_anggota}}</td>
                        <td>{{ $anggota->tempat_lahir_anggota.', '.$anggota->tanggal_lahir_anggota}}</td>
                        <td>{{ $anggota->telepon_anggota}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6>Data Logistik</h6>
        </div>
        <div class="card-body">
            <a href="javascript:;" class="btn btn-primary btn-icon-split mb-2" data-toggle="modal" data-target="#add-modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Logistik</span>
            </a>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>  Barang yang wajib dibawa</strong> 
                <ul>
                    <li>Sleeping Bag</li>
                    <li>Tenda</li>
                    <li>Jas hujan</li>
                    <li>Obat Pribadi</li>
                </ul>
            </div>
             

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($logistiks as $logistik)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $logistik->nama_barang}}</td>
                        <td>{{ $logistik->jumlah_barang}}</td>

                        <td><button type="button" class="btn btn-warning edit-btn" data-toggle="modal" data-target="#edit-modal" data-route="{{ route('logistik.update',$logistik->id)}}" data-nama="{{ $logistik->nama_barang}}" data-jumlah="{{ $logistik->jumlah_barang}}">Edit</button></td>
                        <td><button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal" data-route="{{ route('logistik.destroy',$logistik->id) }}" data-nama="{{ $logistik->nama_barang}}">Hapus</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>

<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Tambah Logistik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('logistik.store')}}" method="POST" id="add-form">
                    @csrf
                    <input type="hidden" name="pendakian_id" value="{{ $pendakian->pendakian_id}}">
                    <div class="form-group">
                        <label for="inputNama">Nama Barang</label>
                        <input type="text" class="form-control" id="inputNama" placeholder="" name="nama_barang" value="{{ old('nama_barang')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputJumlah">Jumlah</label>
                        <input type="text" class="form-control" id="inputJumlah" placeholder="" name="jumlah_barang" value="{{ old('jumlah_barang')}}">
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" form="add-form" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Edit Logistik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edit-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputNama">Nama Barang</label>
                        <input type="text" class="form-control" id="inputNama" placeholder="" name="nama_barang" value="{{ old('nama_barang')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputJumlah">Jumlah</label>
                        <input type="text" class="form-control" id="inputJumlah" placeholder="" name="jumlah_barang" value="{{ old('jumlah_barang')}}">
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
        $('#nav-kriteria').addClass('active')


        $('#dataTable').DataTable();


        $('.delete-btn').click(function() {
            //alert( $(this).data('route'))
            $('#delete-name').html($(this).data('nama'))
            $('#delete-form').attr('action', $(this).data('route'))
        })

        $('.edit-btn').click(function() {
            $('#delete-name').html($(this).data('nama'))
            $('#edit-form').attr('action', $(this).data('route'))
            $('#edit-form #inputNama').val($(this).data('nama'))
            $('#edit-form #inputJumlah').val($(this).data('jumlah'))
        })
    })
</script>

@endpush