class Courses {

    constructor(container_id, modal_id, form_id) {
        this.modal_id = modal_id;
        this.container_id = container_id;
        this.form_id = form_id;

        this.container = $(`#${this.container_id}`);
        this.modal = $(`#${this.modal_id}`);
        this.form  = $(`#${this.form_id}`);
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
        clear_error_forms( this.form );

        axios.post(url_action_form, data_form)
        .then( (response) => {
            const {status, data} = response;

            if ( status == 200 && data.success ) {
                swals("Success", data.message, "success");
                this.form[0].reset();
                blockui_stop();
            }

        })
        .catch( ({response}) => {
            console.log('course submit_form error', response)

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

    handle_click_btn_new_course() {
        this.container.find(`#${this.container_id}_btn_modal_new`).on('click', () => {
            this.modal.modal('show');
        });
    }

    // handle click btn modal new student
    handle_click_modal_new_course_submit() {
        this.modal.find(`#${this.modal_id}_submit`).on('click', () => {
            if ( this.validate_data_form() ) this.submit_form();
        });
    }

    // init
    init() {
        this.handle_click_btn_new_course();
        this.handle_click_modal_new_course_submit();
    }
}
