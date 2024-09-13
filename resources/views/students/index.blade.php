
@php
    $url_component_form_new_student = route("load_component", [section(), 'form_new_student']);

    $heading = (object) [
        [
            'label' => 'ID',
            'key' => 'id'
        ],
        [
            'label' => 'DNI',
            'key' => 'dni',
        ],
        [
            'label' => 'NOMBRE',
            'key' => 'name',
        ],
        [
            'label' => 'APELLIDO',
            'key' => 'last_name',
        ],
        [
            'label' => 'TELEFONO',
            'key' => 'phone',
        ],
        [
            'label' => 'STATUS',
            'key' => 'status',
        ]
    ];

    $members = [];

    if ( empty($members) ) {
        $faker = Faker\Factory::create('es_VE');
        for ($i=0; $i < 50; $i++) {
            $members[] = collect([
                'id' => $i+1,
                'name' => $faker->name(),
                'last_name' => $faker->lastName(),
                'dni' => $faker->nationalId(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->unique()->phoneNumber(),
                'f_bautizmo' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'status' => $faker->randomElement([1, 2, 3])
            ]);
        }
    }
    $members = collect($members);
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

    <script src="{{ asset('Components/table-basic/table-basic.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('Components/table-basic/table-basic.css') }}">

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

        <x-table.table-basic
            name="students"
            :heading="$heading"
            :data="$students"
            :arrow="true"
        />

        <x-table.table-basic
            name="members"
            :heading="$heading"
            :data="$members"
            :arrow="true"
        />

    </div>

    @include('students.components.modal_new_student')
@endsection
