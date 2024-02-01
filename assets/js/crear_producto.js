const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    nombre: /^[a-zA-Z0-9\s]{1,40}$/, //Letras, numeros, guion y guion bajo.
    stock: /^\d{1,8}$/, //7 a 14 numeros.
    descripcion: /^[a-zA-Z0-9\s]{1,40}$/, //Letras, numeros, guion y guion bajo.
    marca: /^[a-zA-Z0-9\s]{1,40}$/, //Letras, numeros, guion y guion bajo.
    precio: /^\d{1,14}$/, //7 a 14 numeros.
}
const campos = {
    nombre: false,
    stock: false,
    descripcion: false,
    marca: false,
    precio: false
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, e.target.name);
            break;
        case "stock":
            validarCampo(expresiones.stock, e.target, e.target.name)
            break;
        case "descripcion":
            validarCampo(expresiones.descripcion, e.target, e.target.name)
            break;
        case "marca":
            validarCampo(expresiones.marca, e.target, e.target.name)
            break;
        case "precio":
            validarCampo(expresiones.precio, e.target, e.target.name)
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

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
    console.log(campos.stock);
    console.log(campos.nombre);
    console.log(campos.tallas);
    console.log(campos.descripcion);
    console.log(campos.categoria);
    console.log(campos.marca);
    console.log(campos.precio);
    console.log(campos.oferta);
});


formulario.addEventListener('submit', (e) => {

    if (campos.stock && campos.nombre && campos.descripcion  && campos.marca && campos.precio) {
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