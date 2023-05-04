@extends('layouts.default')

@push('css')
<link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Pendakian</h1>
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
                        <th>Nama Kelompok</th>
                        <th>Tanggal Berangkat</th>
                        <th>Tanggal Pulang</th>
                        <th>Jumlah Anggota</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($pendakians as $key => $pendakian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$pendakian->nama_kelompok}}</td>
                    <td>{{$pendakian->tanggal_berangkat}}</td>
                    <td>{{$pendakian->tanggal_pulang}}</td>
                    <td>{{$pendakian->jumlah_anggota}}</td>
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
                    <td><span class="badge badge-{{$badgeColor}}">{{ $pendakian->status}}</span></td>
                    <td><a href="{{ route('pendakian.show',$pendakian->pendakian_id) }}" class="btn btn-primary">Detail</button></a>
                </tr>
                @endforeach


                <tbody>


                </tbody>
            </table>
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
            $('#delete-name').html($(this).data('name'))
            $('#delete-form').attr('action', $(this).data('route'))
        })
    })
</script>

@endpush