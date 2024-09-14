@extends('layouts.master')

@section('content')
    <div class="container-fluid" id="course_container">
        <div class="row mt-5">
            <h2>{{ section() }}</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="course_container_btn_modal_new">New</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Report</button>
                </div>
                <small class="text-body-secondary">9 mins</small>
            </div>
        </div>

        <div class="relative min-h-screen flex flex-col selection:bg-[#FF2D20] selection:text-white">

            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <div class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        @foreach ($courses as $course)
                            <x-course.course-card
                                :course="$course"
                            />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('foot')
    <x-form.modal-form
        id="modal_new_course"
        modalTitle="Modal Title FNC"
        :courseTypes="$course_types"
        :courseStatuses="$course_statuses"
    >
        <x-slot name="modal_body">
            @include('courses.components.form_new_course')
        </x-slot>
    </x-form.modal-form>

    <script src="{{ asset('js/courses/courses.js') }}"></script>
    <script>
        jQuery(() => {
            const COURSES = new Courses("course_container", "modal_new_course", "form_new_course");
            COURSES.init();
        });
    </script>
@endsection