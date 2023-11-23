@extends('layouts.master')

@section('foot')
    {{-- DATA TABLES --}}
    <link rel="stylesheet" href="{{asset('dataTables/dataTables.bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('dataTables/buttons_dataTables.min.css')}}" />

    <script src="{{ asset('dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dataTables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dataTables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dataTables/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dataTables/jszip.min.js') }}"></script>
    <script src="{{ asset('dataTables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dataTables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dataTables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dataTables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dataTables/buttons_colVis.min.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <h2>HOME</h2>
        </div>
        <hr/>
        @include('home.members_table')
    </div>
@endsection