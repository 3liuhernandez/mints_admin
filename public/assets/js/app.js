/* *********************************** */
// sweet alert
/* *********************************** */

// sucess
function swals(title, text, button) {
    swal({
        title: title,
        text: text,
        icon: 'success',
        button: button
    });
}


// error
function swale(title, text, button) {
    swal({
        title: title,
        text: text,
        icon: 'error',
        button: button
    });
}

// advertencia
function swalw(title, text, button) {
    swal({
        title: title,
        text: text,
        icon: 'warning',
        button: button
    });
}

// informacion
function swali(title, text, button) {
    swal({
        title: title,
        text: text,
        icon: 'info',
        button: button
    });
}

/* *********************************** */