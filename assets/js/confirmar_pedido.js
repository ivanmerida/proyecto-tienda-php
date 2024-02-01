const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const referencia = document.getElementById('referencia');

const expresiones = {
    municipio: /^[a-zA-Z0-9\s]{1,40}$/, //Letras, numeros, guion y guion bajo.
    localidad: /^[a-zA-Z\s]{1,40}$/, //Letras espacios, pueden llevar acentos.
    direccion: /^[a-zA-Z0-9\s]{1,40}$/, //Letras, numeros, guion y guion bajo.
    telefono: /^\d{7,14}$/ //7 a 14 numeros.
}

const campos = {
    municipio: false,
    localidad: false,
    direccion: false,
    referencia: false,
    telefono: false
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "municipio":
            validarCampo(expresiones.municipio, e.target, e.target.name);
            break;
        case "localidad":
            validarCampo(expresiones.localidad, e.target, e.target.name);
            break;
        case "direccion":
            validarCampo(expresiones.direccion, e.target, e.target.name);
            break;
        case "referencia":
            validarReferencia(e.target.name);
            break;
        case "telefono":
            validarCampo(expresiones.telefono, e.target, e.target.name);
            break;
    }
}
const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
}
const validarReferencia = (campo) => {
    if (referencia == '') {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
formulario.addEventListener('submit', (e) => {
    const terminos = document.getElementById('terminos');
    if (campos.municipio && campos.localidad && campos.direccion && campos.referencia && campos.telefono && terminos.checked) {
        // formulario.reset();   
        document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
        setTimeout(() => {
            document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
        }, 5000);
        document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
            icono.classList.remove('formulario__grupo-correcto');
        });
        document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    } else {
        e.preventDefault();
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
    }

});