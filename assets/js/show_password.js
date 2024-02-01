'use strict';

var show_password = document.getElementById('show-password');

var password = document.getElementById('password');
var password2 = document.getElementById('password2');
var show_password2 = document.getElementById('show-password2');

show_password.addEventListener('click', function () {
    if (password.type == 'password') {
        password.type = 'text';
        show_password.src = "http://localhost/university__projects/the__blossom/imagenes/iconos/mostrar.svg";
        setTimeout(function () {
            password.type = 'password';
            show_password.src = "http://localhost/university__projects/the__blossom/imagenes/iconos/ocultar.svg";
        }, 3000);
    } else {
        password.type = 'password';
        show_password.src = "http://localhost/university__projects/the__blossom/imagenes/iconos/ocultar.svg";
    }
});

show_password2.addEventListener('click', function () {
    if (password2.type == 'password') {
        password2.type = 'text';
        show_password2.src = "http://localhost/university__projects/the__blossom/imagenes/iconos/mostrar.svg";
        setTimeout(function () {
            password2.type = 'password';
            show_password2.src = "http://localhost/university__projects/the__blossom/imagenes/iconos/ocultar.svg";
        }, 3000);
    } else {
        password2.type = 'password';
        show_password2.src = "http://localhost/university__projects/the__blossom/imagenes/iconos/ocultar.svg";
    }
});