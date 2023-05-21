@extends('layouts.default')

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <ul class="nav nav-progress">
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

                        <form action="" method="" id="form-1">

                            <div class="form-group">
                                <label for="inputNim">Nama Ketua Kelompok</label>
                                <input type="text" class="form-control" id="input_ketua_nama" placeholder="" name="ketua_nama" value="{{ old('ketua_nama') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="inputNim">Jenis Kelamin Ketua Kelompok</label>
                                <select class="form-control" id="input_ketua_jenis_kelamin" name="ketua_jenis_kelamin" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input_ketua_tempat_lahir">Tempat Lahir Ketua Kelompok</label>
                                <div class="form-group">
                                    <select class="form-control select2" id="input_ketua_tempat_lahir" name="ketua_tempat_lahir" style="width: 100%;" required>
                                        <option value="">-- Pilih Kabupaten / Kota</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id}}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="inpu_ketua_tgl_lahir">Tanggal Lahir Ketua Kelompok</label>
                                <div class="datepicker date input-group">
                                    <input type="text" class="form-control" id="inpu_ketua_tgl_lahir" placeholder="" name="ketua_telepon" value="{{ old('ketua_telepon') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input_ketua_telepon">No Telepon Ketua Kelompok</label>
                                <input type="text" class="form-control" id="input_ketua_telepon" placeholder="" name="ketua_telepon" value="{{ old('ketua_telepon') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="input_tgl_berangkat">Tanggal Berangkat</label>
                                <div class="datepicker date input-group">
                                    <input type="text" class="form-control" id="input_tgl_berangkat" placeholder="" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="input_tgl_pulang">Tanggal Pulang</label>
                                <div class="datepicker date input-group">
                                    <input type="text" class="form-control" id="input_tgl_pulang" placeholder="" name="tanggal_pulang" value="{{ old('tanggal_pulang') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input_jumlah_anggota">Jumlah Anggota</label>
                                <input type="text" class="form-control" id="input_jumlah_anggota" placeholder="" name="jumlah_anggota" value="{{ old('jumlah_anggota') }}" required>
                            </div>

                        </form>

                    </div>
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">

                        <form action="{{ route('pendakian.store')}}" method="post" id="form-2">
                            @csrf
                            <input type="hidden" name="data_pendakian[ketua_nama]" id="confrom_ketua_nama">
                            <input type="hidden" name="data_pendakian[ketua_jenis_kelamin]" id="confrom_ketua_jenis_kelamin">
                            <input type="hidden" name="data_pendakian[ketua_tempat_lahir]" id="confrom_ketua_tempat_lahir">
                            <input type="hidden" name="data_pendakian[ketua_tgl_lahir]" id="confrom_ketua_tgl_lahir">
                            <input type="hidden" name="data_pendakian[ketua_telepon]" id="confrom_ketua_telepon">
                            <input type="hidden" name="data_pendakian[tanggal_berangkat]" id="confrom_tanggal_berangkat">
                            <input type="hidden" name="data_pendakian[tanggal_pulang]" id="confrom_tanggal_pulang">
                            <input type="hidden" name="data_pendakian[jumlah_anggota]" id="confrom_jumlah_anggota">

                            <div id="anggota-1">
                                <div class="form-group">
                                    <label for="inputNim">Nama Anggota </label>
                                    <input type="text" class="form-control" id="inputNim" placeholder="" name="data_anggota[nama_anggota][]" value="{{ old('nama_anggota')  }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim">Alamat Anggota </label>
                                    <input type="text" class="form-control" id="inputNim" placeholder="" name="data_anggota[alamat_anggota][]" value="{{ old('alamat_anggota')  }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim">Jenis Kelamin Anggota </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="data_anggota[jenis_kelamin_anggota][]" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim">Tempat Lahir Anggota </label>

                                    <div class="form-group" required>
                                        <select class="form-control select2" id="tempat_lahir_anggota" name="data_anggota[tempat_lahir_anggota][]" style="width: 100%;">
                                            <option value="">-- Pilih Kabupaten / Kota</option>
                                            @foreach($cities as $city)
                                            <option value="{{ $city->id}}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="inputNim">Tanggal Lahir Anggota </label>
                                    <div class="datepicker date input-group">
                                        <input type="text" class="form-control" id="inputNim" placeholder="" name="data_anggota[tanggal_lahir_anggota][]" value="{{ old('tanggal_lahir_anggota')  }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim">No Telepon Anggota </label>
                                    <input type="text" class="form-control" id="inputNim" placeholder="" name="data_anggota[telepon_anggota][]" value="{{ old('telepon_anggota')  }}" required>
                                </div>
                                <hr>
                            </div>
                        </form>


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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Page level custom scripts -->

<script>
    function onCancel() {
        $('#smartwizard').smartWizard("reset");

        document.getElementById("form-1").reset();
        document.getElementById("form-2").reset();
    }

    function onConfirm() {
        let form = document.getElementById('form-2');
        form.submit();
    }

    function showConfirm() {
        var ketua_nama = $('#input_ketua_nama').val();
        var ketua_jenis_kelamin = $('#input_ketua_jenis_kelamin').val();
        var ketua_tempat_lahir = $('#input_ketua_tempat_lahir').val();
        var ketua_tgl_lahir = $('#inpu_ketua_tgl_lahir').val();
        var ketua_telepon = $('#input_ketua_telepon').val();
        var tgl_berangkat = $('#input_tgl_berangkat').val();
        var tgl_pulang = $('#input_tgl_pulang').val();
        var jumlah_anggota = $('#input_jumlah_anggota').val();

        $('#confrom_ketua_nama').val(ketua_nama);
        $('#confrom_ketua_jenis_kelamin').val(ketua_jenis_kelamin);
        $('#confrom_ketua_tempat_lahir').val(ketua_tempat_lahir);
        $('#confrom_ketua_telepon').val(ketua_telepon);
        $('#confrom_ketua_tgl_lahir').val(ketua_tgl_lahir);
        $('#confrom_tanggal_berangkat').val(tgl_berangkat);
        $('#confrom_tanggal_pulang').val(tgl_pulang);
        $('#confrom_jumlah_anggota').val(jumlah_anggota);

        for (var i = 1; i < jumlah_anggota; i++) {

            $('#anggota-1')
                .clone()
                .attr('id', 'anggota' + i)
                .insertAfter('#anggota-1')
        }
        refreshSelect();

    }

    function refreshSelect() {
        $(".select2").select2();
    }

    $(document).ready(function() {
        $('#nav-anggota').addClass('active')

        refreshSelect();


        $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
            // Validate only on forward movement  
            if (stepDirection == 'forward') {
                let form = document.getElementById('form-' + (currentStepIdx + 1));
                if (form) {
                    if (!form.checkValidity()) {
                        form.classList.add('was-validated');
                        //$('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        //$("#smartwizard").smartWizard('fixHeight');
                        return false;
                    }
                    $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                }
            }
        });

        // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {

            //$("#prev-btn").removeClass('disabled').prop('disabled', false);
            //$("#next-btn").removeClass('disabled').prop('disabled', false);
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled').prop('disabled', true);
            } else if (stepPosition === 'last') {
                $("#next-btn").addClass('disabled').prop('disabled', true);
            } else {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
            }
            if (stepPosition == 'last') {
                showConfirm();
                $("#btnFinish").prop('disabled', false);
            } else {
                $("#btnFinish").prop('disabled', true);
            }


        });

        $('#smartwizard').smartWizard({
            selected: 0,
            // autoAdjustHeight: false,
            theme: 'arrows',
            toolbar: {
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                position: 'bottom', // none/ top/ both bottom
                extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onConfirm()">Complete Order</button>
                              <button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
            },
            anchor: {
                enableNavigation: true, // Enable/Disable anchor navigation 
                enableNavigationAlways: false, // Activates all anchors clickable always
                enableDoneState: true, // Add done state on visited steps
                markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                enableDoneStateNavigation: true // Enable/Disable the done state navigation
            },
        });

        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "yyyy-mm-dd"
        });

    })
</script>

@endpush