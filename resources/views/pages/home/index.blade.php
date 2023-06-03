@extends('layouts.default2')

@section('content')
<div class="container-fluid" >

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4" >
        <h1 class="h3 mb-0 text-gray-800">Dashboard <small>{{ config('site.name')}}</small></h1>

    </div>
    <div class="row">

  @if(auth()->user()->is_admin)
     <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total pendafataran</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$total_pendaftaran}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Pendaki Bulan Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$total_pendaki}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Pendaki Laki-Laki</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$jenis_kelamin->jumlah_laki}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-male fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Pendaki Bulan Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$jenis_kelamin->jumlah_perempuan}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-female fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    @endif                       

                      
    </div>

    @push('scripts')
    <script>
        $(document).ready(function(){
            $('#nav-home').addClass('active')
        })
    </script>
    @endpush

</div>
@endsection