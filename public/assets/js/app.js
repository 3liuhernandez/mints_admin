
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$("#salir").on('click', function (e) {
    e.preventDefault();
    window.location = "logout";
});


function showSpiner() {
    $('#modal_spinner').css('display', 'block');
}


function hideSpiner() {
    $('#modal_spinner').css('display', 'none');
}


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

const load_component = ( url, $container ) => {
    axios.get(url)
    .then( (response) => {
        if ( response.data.component ) $container.html(response.data.component)
    })
    .catch( (response) => {
        console.log('load_component catch response', response)
    })
};



/**
 * FUNC START BLOCK UI
 **/

const blockui = (msg = "") => {

    $('.blockUI.blockMsg.blockPage').css('border-width', '3px');

    $.blockUI({ message: `  ${msg}  ` });
    NProgress.start();

    if ( msg == "" ) {
        $('.blockUI.blockMsg.blockPage').css('border-width', 0);
    }

    $(document).css("overflow", "hidden");
};

/**
 * FUNC STOP BLOCK UI
 **/
const blockui_stop = () => {
    setTimeout(() => {
        $.unblockUI();
        NProgress.done();
    }, 500);

};

/**
 * FUNC STOP BLOCK UI STYLE
 **/
const fnLoadblockUI = function () {
    $.blockUI.defaults.css = {
        padding: 0,
        margin: 0,
        width: "30%",
        top: "40%",
        left: "35%",
        textAlign: "center",
        cursor: "wait",
        color: "#fff",
        fontSize: "3rem",
        textTransform: "oblique",
        textDecoration: "underline",
        fontStyle: "italic",
        zIndex: "1025",
    };
    $.blockUI.defaults.message = "";
    return false;
};

jQuery(() => {
    fnLoadblockUI();

    () => {
        NProgress.configure({
            template:
                '<div class="bar" role="bar"><div class="peg"></div></div>',
        });
    };

    // show_toast('mensaje que va en el toast');
    // blockui( 'cargando' )
    setTimeout(() => {
        // blockui_stop()
    }, 1000);


    $('[data-toggle="tooltip"]').tooltip();
});
