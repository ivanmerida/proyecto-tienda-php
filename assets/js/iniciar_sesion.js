const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    password: /^.{6,20}$/, //6 a 20 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}
const campos = {
    password: false,
    correo: false,
}

const validarFormulario = (e) => {
    switch (e.target.name){
        case "password":
            validarCampo(expresiones.password, e.target, e.target.name)
            validarPassword2();
        break;
        case "correo":
            validarCampo(expresiones.correo, e.target, e.target.name)
        break;
    }
}
const validarCampo = (expresion, input, campo) => {
    if(expresion.test(input.value)){
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    }else{
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario); //keyup - levantar la tecla
    input.addEventListener('blur', validarFormulario); // blur - cuando presiones fuera del campo
});
formulario.addEventListener('submit', (e) =>{
    if(campos.correo && campos.password){
        document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
        setTimeout(() => {
            document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
        }, 5000);
        document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
            icono.classList.remove('formulario__grupo-correcto');
        });
        document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    }else{
        e.preventDefault();
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
    }
    
});