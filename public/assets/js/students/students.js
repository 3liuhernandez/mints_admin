const student = () => {
    const $modal_new_student = $('#modal_new_student');
    const $form_new_student = $('#form_new_student');

    // load_component(url_component_form_new_student, $("#container_form_new_student"));
    $modal_new_student.on('shown.bs.modal', function() {
        const is_form_filled = check_if_form_filled();
        if ( is_form_filled ) return handle_clean_form();
        load_component(url_component_form_new_student, $("#container_form_new_student"));
    });

    const handle_clean_form = () => {
        const action = confirm('limpiar formulario?');
        let confirm_clean = false;
        if ( action ) confirm_clean = confirm('confimar limpiar formulario');
        // if ( confirm_clean ) $form_new_student[0].reset();
        if ( confirm_clean ) load_component(url_component_form_new_student, $("#container_form_new_student"));
    }

    const check_if_form_filled = () => {
        const data = $form_new_student.serialize();

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

class Students {

    constructor() {
        this.container = $('#student_container');
        this.modal = $('#modal_new_student');
        this.form  = $('#form_new_student');
    }

    // get data form
    get_data_form() {
        return this.form.serialize();
    }

    validate_data_form () {
        const data = this.get_data_form();
        console.log('data =>', data);
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

    submit_form () {
        const data_form = this.get_data_form();
        const url_action_form = this.form.attr('action');

        blockui("");

        // clean error forms
        clear_error_forms( $('#form_new_student') );

        axios.post(url_action_form, data_form)
        .then( (response) => {
            const {status, data} = response;

            if ( status == 200 && data.success ) {
                swals("Success", data.message, "success");
                // load_component(url_component_form_new_student, $("#container_form_new_student"));
                this.form[0].reset();
                blockui_stop();
            }

        })
        .catch( ({response}) => {
            console.log('student submit_form error', response)

            blockui_stop();

            const {status, data} = response;

            // errores de validacion del formulario
            if ( status == 422 && data.validator ) return show_error_form(data.validator);

            // Autenticación incorrecta
            if ( status == 422 && !data.success ) return swale(data.message, "", "ok");

            // error interno
            if ( status == 500 ) return swali("Ups", "estamos teniendo problemas internos, vuelve a intentar más tarde", "ok")
        })
    }

    // handle click btn modal new student
    handle_click_modal_new_student_submit() {
        this.modal.find('#modal_new_student_submit').on('click', () => {
            if ( this.validate_data_form() ) this.submit_form();
        });
    }

    handle_click_btn_new_student() {
        this.container.find('#btn_new_student').on('click', () => {
            this.modal.modal('show');
        });
    }

    handle_change_fields_form() {
        this.form.find('input[type="number"]').on('keyup', (event) => {
            const field = $(event.target);
            const value = field.val();
            if ( value.length == 1 && value == "0" ) field.val('');
        });
    }

    // init
    init() {
        this.handle_click_modal_new_student_submit();
        this.handle_click_btn_new_student();
        this.handle_change_fields_form();
    }
}