@extends('layouts.default')

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Tambah Alternative </h1>
    </div>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <div id="smartwizard">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#step-1">
                            <div class="num">1</div>
                            Form Jadwal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-2">
                            <span class="num">2</span>
                            Form Anggota
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                        @if($step == 0)
                        <form action="{{ route('pendakian.store') }}" method="post" id="firstForm">
                            @csrf
                            <input type="hidden" name="step" value="0">
                            <div class="form-group">
                                <label for="inputNim">Nama Kelompok</label>
                                <input type="text" class="form-control" id="inputNim" placeholder="" name="nama_kelompok" value="{{ old('nama_kelompok') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputNim">Tanggal Berangkat</label>
                                <div class="datepicker date input-group">
                                    <input type="text" class="form-control" id="inputNim" placeholder="" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="inputNim">Tanggal Pulang</label>
                                <div class="datepicker date input-group">
                                    <input type="text" class="form-control" id="inputNim" placeholder="" name="tanggal_pulang" value="{{ old('tanggal_pulang') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNim">Jumlah Anggota</label>
                                <input type="text" class="form-control" id="inputNim" placeholder="" name="jumlah_anggota" value="{{ old('jumlah_anggota') }}">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Next</button>
                            </div>
                        </form>
                        @endif
                    </div>
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        @if($step == 1)
                        <form action="{{ route('pendakian.store') }}" method="post" id="secondForm">
                            @csrf
                            <input type="hidden" name="step" value="1">
                            <input type="hidden" name="pendakian_id" value="{{$id}}">
                            @for ($i=0; $i < $anggota ; $i++) <div class="form-group">
                                <label for="inputNim">Nama Anggota {{$i +1}}</label>
                                <input type="text" class="form-control" id="inputNim" placeholder="" name="nama_anggota[]" value="{{ old('nama_anggota')[$i] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="inputNim">Alamat Anggota {{$i +1}}</label>
                        <input type="text" class="form-control" id="inputNim" placeholder="" name="alamat_anggota[]" value="{{ old('alamat_anggota')[$i] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="inputNim">Jenis Kelamin Anggota {{$i +1}}</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin_anggota[]">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputNim">Tempat Lahir Anggota {{$i +1}}</label>
                        <input type="text" class="form-control" id="inputNim" placeholder="" name="tempat_lahir_anggota[]" value="{{ old('tempat_lahir_anggota')[$i] ?? '' }}">
                    </div>
                    <div class="form-group">

                        <label for="inputNim">Tanggal Lahir Anggota {{$i +1}}</label>
                        <div class="datepicker date input-group">
                            <input type="text" class="form-control" id="inputNim" placeholder="" name="tanggal_lahir_anggota[]" value="{{ old('tanggal_lahir_anggota')[$i] ?? '' }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNim">No Telepon Anggota {{$i +1}}</label>
                        <input type="text" class="form-control" id="inputNim" placeholder="" name="telepon_anggota[]" value="{{ old('telepon_anggota')[$i] ?? '' }}">
                    </div>
                    @endfor
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Sumbit</button>
                    </div>
                    </form>
                    @endif

                </div>
            </div>

            <!-- Include optional progressbar HTML -->
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>


</div>

@endsection

@push('scripts')
<script src="{{ URL::asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Page level custom scripts -->

<script>
    $(document).ready(function() {
        $('#nav-anggota').addClass('active')



        $('#smartwizard').smartWizard({
            selected: <?php echo $step ?>,
            // autoAdjustHeight: false,
            theme: 'arrows',
            toolbar: {
                showNextButton: false, // show/hide a Next button
                showPreviousButton: false, // show/hide a Previous button
            }
        });

        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "yyyy-mm-dd"
        });

    })
</script>

@endpush