
@php
    $url_component_form_new_member = route("load_component", [section(), 'form_new_member']);
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


    <script>
        jQuery(() => {
            member();
        });

        const member = () => {
            const $modal_new_member = $('#modal_new_member');
            const $form_new_member = $('#form_new_member');

            // handle click btn new member
            $('#btn_new_member').on('click', function() {
                $modal_new_member.modal('show');
            });

            // handle submit form new member
            $('#modal_new_member_submit').on('click', function() {
                if ( validate_data_form() ) submit_form();
            });

            // submit form
            const submit_form = () => {
                const data_form = $form_new_member.serialize();
                const url_action_form = $form_new_member.attr('action');
                axios.post(url_action_form, data_form)
                .then( (response) => {
                    const {status, data} = response;
                    console.log('member submit_form then', response)
                })
                .catch( (error) => {
                    console.log('member submit_form error', error)
                })
            }

            // load_component("{{$url_component_form_new_member}}", $("#container_form_new_member"));
            $modal_new_member.on('shown.bs.modal', function() {
                const is_form_filled = check_if_form_filled();
                if ( is_form_filled ) handle_clean_form();
            });

            const handle_clean_form = () => {
                const action = confirm('limpiar formulario?');
                let confirm_clean = false;
                if ( action ) confirm_clean = confirm('confimar limpiar formulario');
                if ( confirm_clean ) $form_new_member[0].reset();
            }

            const validate_data_form = () => {
                const data = $form_new_member.serialize();
                const validation = [];

                for (const field of data.split('&')) {
                    const field_parts = field.split('=');
                    let key_field = field_parts[0];
                    let value_field = field_parts[1];

                    const $field = $(`#${key_field}`);
                    $field.removeClass('is-invalid is-required');

                    if ( !value_field ) {
                        if ( $field.hasClass('nullable') ) continue;

                        $field.addClass('is-invalid is-required');
                        console.log('key_field', key_field)
                        validation.push(false);
                    }
                }

                console.log('validation', validation)
                return validation.every(x => x === true);
            }

            const check_if_form_filled = () => {
                const data = $form_new_member.serialize();

                let is_filled = false;

                for (const field of data.split('&')) {
                    const field_parts = field.split('=');
                    let key_field = field_parts[0];
                    let value_field = field_parts[1];

                    if ( key_field == "_token" ) continue;
                    if ( value_field ) is_filled = true;
                    if ( is_filled ) break;
                }

                return is_filled;
            }
        };

    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <h2>{{ section() }}</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn_new_member">New</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Report</button>
                </div>
                <small class="text-body-secondary">9 mins</small>
            </div>
        </div>

        <hr>
        @include('home.members_table')

    </div>


    <div class="modal modal-sheet p-4 py-md-5" tabindex="-1" role="dialog" id="modal_new_member">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0" id="container_form_new_member">
                    <p>This is a modal sheet, a variation of the modal that docs itself to the bottom of the viewport like
                        the newer share sheets in iOS.</p>
                    @include('memberships.components.form_new_member', $coords)
                </div>
                <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                    <button type="button" class="btn btn-lg btn-primary" id="modal_new_member_submit">Save</button>
                    <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal" id="modal_new_member_close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
