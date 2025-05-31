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
var expRegTxtPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
var expRegTxtDireccion = /^[a-zA-Z0-9\s,.'-]{3,}$/;

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

function validarNombre() {
    var objetoNombre = document.getElementById("nombre");
    var errorElement = document.getElementById("error-nombre");
    if ((expRegTxtNombre.test(objetoNombre.value)) == true) {
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
    if ((expRegTxtNombre.test(objetoApellido.value)) == true) {
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
    if ((objetoTelefono.value != '') &&
        (objetoTelefono.value.length >= longitudMinimaTelefono) &&
        expRegNumeroEnteroPositivo.test(objetoTelefono.value)) {
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
    var email = objetoEmail.value.toLowerCase();
    email = comprobarAtEmail(email);
    if ((expRegTxtEmail.test(email)) == true) {
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
    if ((expRegTxtPassword.test(objetoPassword.value)) == true) {
        passwordOk = true;
        estiloCORRECTO(objetoPassword, errorElement);
    } else {
        passwordOk = false;
        estiloINCORRECTO(objetoPassword, errorElement, "La contraseña debe tener al menos 8 caracteres, incluyendo una letra, un número y un carácter especial.");
    }
}

function validarDireccion() {
    var objetoDireccion = document.getElementById("direccion");
    var errorElement = document.getElementById("error-direccion");
    if ((expRegTxtDireccion.test(objetoDireccion.value)) == true) {
        direccionOk = true;
        estiloCORRECTO(objetoDireccion, errorElement);
    } else {
        direccionOk = false;
        estiloINCORRECTO(objetoDireccion, errorElement, "La dirección debe ser válida, por ejemplo: Calle 123.");
    }
}

function mostrarMensajeExito() {
    var successMessage = document.getElementById("success-message");
    successMessage.classList.add("show");
    setTimeout(function() {
        document.forms["miniformulario"].submit();
    }, 3000); 
}
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