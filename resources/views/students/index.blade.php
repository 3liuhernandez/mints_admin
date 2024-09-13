
@php
    $url_component_form_new_student = route("load_component", [section(), 'form_new_student']);
@endphp

@extends('layouts.master')

@section('foot')
    {{-- DATA TABLES --}}
    <link rel="stylesheet" href="{{ asset('dataTables/dataTables.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dataTables/buttons_dataTables.min.css') }}" />

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


    <script src="{{ asset('js/students/students.js') }}"></script>
    <script>
        const url_component_form_new_student = "{{$url_component_form_new_student}}";
        jQuery(() => {
            const STUDENTS = new Students();
            STUDENTS.init();
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid" id="student_container">
        <div class="row mt-5">
            <h2>{{ section() }}</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn_new_student">New</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Report</button>
                </div>
                <small class="text-body-secondary">9 mins</small>
            </div>
        </div>

        <hr>
        @include('home.members_table', ['data' => $students])

    </div>

    @include('students.components.modal_new_student')
@endsection
