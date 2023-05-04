@extends('layouts.default2')

@section('content')
<div class="container-fluid" >

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4" >
        <h1 class="h3 mb-0 text-gray-800">Dashboard <small>{{ config('site.name')}}</small></h1>

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