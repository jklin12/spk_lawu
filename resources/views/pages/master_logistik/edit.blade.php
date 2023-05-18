@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Kriteria</h1>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('master_logistik.update',$logistik->master_logistik_id )}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="inputNim">Jenis Keperluan</label>
                    <select class="form-control" id="input_logistik_jenis" name="master_logistik_jenis" required>
                        <option value="">-- Pilih Jenis Keperluan --</option>
                        <option value="Kelompok">Kelompok</option>
                        <option value="Individu">Individu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputNim">Wajib</label>
                    <select class="form-control" id="input_logistik_wajib" name="master_logistik_wajib" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputNama">Nama Logistik</label>
                    <input type="text" class="form-control" id="inputNama" placeholder="Masukan Nama" name="master_logistik_nama" value="{{ $logistik->master_logistik_nama }}">
                </div>

                <div class="d-sm-flex justify-content-center mb-2">
                    <button class="btn btn-primary btn-icon-split " type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>


    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#nav-master_logistik').addClass('active')

            $('#input_logistik_wajib').val('<?= $logistik->master_logistik_wajib ?>').change()
            $('#input_logistik_jenis').val('<?= $logistik->master_logistik_jenis ?>').change()


        })
    </script>
    @endpush

</div>
@endsection