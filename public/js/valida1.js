// Variables de validación
var mostrarResultadoValidacion = true;
var nombreOk = false;
var apellidoOk = false;
var emailOk = false;
var telefonoOk = false;
var passwordOk = false;
var direccionOk = false;
var longitudMinimaTelefono = 7;
var expRegNumeroEntero = /^-?[0-9]*$/;
var expRegNumeroEnteroPositivo = /^[0-9]*$/;
var expRegTxtNombre = /^[A-Z~-ÿ]{1}[~-ÿ\s\w\.\'-]{1,}$/i;
var expRegTxtEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
var expRegTxtPassword = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;
var expRegTxtDireccion = /^.*$/;

// Funciones de estilo
function estiloINGRESO() {
    this.style.backgroundColor = "cyan";
}

function estiloCORRECTO(inputElement, errorElement) {
    inputElement.style.background = 'transparent';
    if (errorElement) {
        errorElement.textContent = '';
    }
}

function estiloINCORRECTO(inputElement, errorElement, errorMessage) {
    inputElement.style.backgroundColor = "";
    if (errorElement) {
        errorElement.textContent = errorMessage;
    }
}

// Funciones de validación
function validarNombre() {
    var objetoNombre = document.getElementById("nombre");
    var errorElement = document.getElementById("error-nombre");
    if (expRegTxtNombre.test(objetoNombre.value)) {
        nombreOk = true;
        estiloCORRECTO(objetoNombre, errorElement);
    } else {
        nombreOk = false;
        estiloINCORRECTO(objetoNombre, errorElement, "El nombre debe comenzar con una letra y puede contener espacios, letras, números, puntos y guiones.");
    }
}

function validarApellido() {
    var objetoApellido = document.getElementById("apellido");
    var errorElement = document.getElementById("error-apellido");
    if (expRegTxtNombre.test(objetoApellido.value)) {
        apellidoOk = true;
        estiloCORRECTO(objetoApellido, errorElement);
    } else {
        apellidoOk = false;
        estiloINCORRECTO(objetoApellido, errorElement, "El apellido debe comenzar con una letra y puede contener espacios, letras, números, puntos y guiones.");
    }
}

function validarTelefono() {
    var objetoTelefono = document.getElementById("telefono");
    var errorElement = document.getElementById("error-telefono");
    if (objetoTelefono.value !== '' && objetoTelefono.value.length >= longitudMinimaTelefono && expRegNumeroEnteroPositivo.test(objetoTelefono.value)) {
        telefonoOk = true;
        estiloCORRECTO(objetoTelefono, errorElement);
    } else {
        telefonoOk = false;
        estiloINCORRECTO(objetoTelefono, errorElement, "El teléfono debe contener al menos " + longitudMinimaTelefono + " dígitos y solo números.");
    }
}

function validarEmail() {
    var objetoEmail = document.getElementById("email");
    var errorElement = document.getElementById("error-email");
    var email = comprobarAtEmail(objetoEmail.value.toLowerCase());
    if (expRegTxtEmail.test(email)) {
        emailOk = true;
        objetoEmail.value = email;
        estiloCORRECTO(objetoEmail, errorElement);
    } else {
        emailOk = false;
        estiloINCORRECTO(objetoEmail, errorElement, "El email debe ser válido, por ejemplo: usuario@dominio.com.");
    }
}

function comprobarAtEmail(email) {
    var expresion = /\sat\s/g;
    return email.replace(expresion, '@');
}

function validarPassword() {
    var objetoPassword = document.getElementById("password");
    var errorElement = document.getElementById("error-password");
    if (expRegTxtPassword.test(objetoPassword.value)) {
        passwordOk = true;
        estiloCORRECTO(objetoPassword, errorElement);
    } else {
        passwordOk = false;
        estiloINCORRECTO(objetoPassword, errorElement, "La contraseña debe tener al menos 8 caracteres, incluyendo al menos una letra y un número.");
    }
}

function validarDireccion() {
    var objetoDireccion = document.getElementById("direccion");
    var errorElement = document.getElementById("error-direccion");
    if (expRegTxtDireccion.test(objetoDireccion.value)) {
        direccionOk = true;
        estiloCORRECTO(objetoDireccion, errorElement);
    } else {
        direccionOk = false;
        estiloINCORRECTO(objetoDireccion, errorElement, "La dirección debe ser válida, por ejemplo: Calle 123.");
    }
}

// Función para mostrar alerta de éxito con SweetAlert2
function mostrarMensajeExito() {
    Swal.fire({
        icon: 'success',
        title: 'Registro exitoso',
        text: '¡Te has registrado correctamente!',
        showConfirmButton: false,
        timer: 2000 // La alerta desaparece automáticamente después de 2 segundos.
    });

    setTimeout(function() {
        document.forms["miniformulario"].submit();
    }, 2000); // Enviar el formulario después de que la alerta se cierre.
}

// Función de validación general
function validarDatos() {
    validarNombre();
    validarApellido();
    validarEmail();
    validarTelefono();
    validarPassword();
    validarDireccion();

    if (nombreOk && apellidoOk && emailOk && telefonoOk && passwordOk && direccionOk) {
        mostrarMensajeExito();
        return false;
    } else {
        return false;
    }
}

// Eventos de validación
document.getElementById("nombre").addEventListener("focus", estiloINGRESO);
document.getElementById("apellido").addEventListener("focus", estiloINGRESO);
document.getElementById("email").addEventListener("focus", estiloINGRESO);
document.getElementById("telefono").addEventListener("focus", estiloINGRESO);
document.getElementById("password").addEventListener("focus", estiloINGRESO);
document.getElementById("direccion").addEventListener("focus", estiloINGRESO);

document.getElementById("nombre").addEventListener("blur", validarNombre);
document.getElementById("apellido").addEventListener("blur", validarApellido);
document.getElementById("email").addEventListener("blur", validarEmail);
document.getElementById("telefono").addEventListener("blur", validarTelefono);
document.getElementById("password").addEventListener("blur", validarPassword);
document.getElementById("direccion").addEventListener("blur", validarDireccion);
