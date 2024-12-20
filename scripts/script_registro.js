const formulario = document.getElementById('registroForm');
const inputs = document.querySelectorAll('#registroForm input');

const expresiones = {
    cedula: /^\d{10}$/, // 10 números, sin letras ni caracteres especiales.
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    lugar: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    telefono: /^\d{10}$/, // 10 números.
    mail: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/, // Correos válidos.
    username: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, números, guion y guion bajo.
    password: /^.{6,12}$/, // 6 a 12 dígitos.
};

const campos = {
    cedula: false,
    nombre: false,
    apellido: false,
    lugar: false,
    telefono: false,
    mail: false,
    username: false,
    password: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "cedula":
            validarCampo(expresiones.cedula, e.target, 'cedula');
            break;
        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre');
            break;
        case "apellido":
            validarCampo(expresiones.apellido, e.target, 'apellido');
            break;
        case "lugar":
            validarCampo(expresiones.lugar, e.target, 'lugar');
            break;
        case "telefono":
            validarCampo(expresiones.telefono, e.target, 'telefono');
            break;
        case "mail":
            validarCampo(expresiones.mail, e.target, 'mail');
            break;
        case "username":
            validarCampo(expresiones.username, e.target, 'username');
            break;
        case "password":
            validarCampo(expresiones.password, e.target, 'password');
            validarPassword2();
            break;
        case "password2":
            validarPassword2();
            break;
    }

    manejarMensajeErrorGeneral();
};

const validarCampo = (expresion, input, campo) => {
    const grupo = document.getElementById(`grupo__${campo}`);
    const icono = grupo.querySelector('i');
    const error = grupo.querySelector('.form__input-error');

    if (expresion.test(input.value)) {
        grupo.classList.remove('formulario__grupo-incorrecto');
        grupo.classList.add('formulario__grupo-correcto');
        icono.classList.add('fa-check-circle');
        icono.classList.remove('fa-times-circle');
        error.classList.remove('form__input-error-activo');
        campos[campo] = true;
    } else {
        grupo.classList.add('formulario__grupo-incorrecto');
        grupo.classList.remove('formulario__grupo-correcto');
        icono.classList.add('fa-times-circle');
        icono.classList.remove('fa-check-circle');
        error.classList.add('form__input-error-activo');
        campos[campo] = false;
    }
    console.log(`${campo} validado:`, campos[campo]);  
    console.log('Valor actual del campo:', input.value);  

};

const validarPassword2 = () => {
    const inputPassword1 = document.getElementById('password');
    const inputPassword2 = document.getElementById('password2');
    const grupoPassword2 = document.getElementById('grupo__password2');
    const icono = grupoPassword2.querySelector('i');
    const error = grupoPassword2.querySelector('.form__input-error');

    if (!expresiones.password.test(inputPassword1.value)) {
        grupoPassword2.classList.add('formulario__grupo-incorrecto');
        grupoPassword2.classList.remove('formulario__grupo-correcto');
        icono.classList.add('fa-times-circle');
        icono.classList.remove('fa-check-circle');
        error.classList.add('form__input-error-activo');
        campos['password'] = false;
    } else if (inputPassword1.value !== inputPassword2.value) {
        grupoPassword2.classList.add('formulario__grupo-incorrecto');
        grupoPassword2.classList.remove('formulario__grupo-correcto');
        icono.classList.add('fa-times-circle');
        icono.classList.remove('fa-check-circle');
        error.classList.add('form__input-error-activo');
        campos['password'] = false;
    } else {
        grupoPassword2.classList.remove('formulario__grupo-incorrecto');
        grupoPassword2.classList.add('formulario__grupo-correcto');
        icono.classList.remove('fa-times-circle');
        icono.classList.add('fa-check-circle');
        error.classList.remove('form__input-error-activo');
        campos['password'] = true;
    }
};

const manejarMensajeErrorGeneral = () => {
    const mensajeErrorGeneral = document.getElementById('formulario__mensaje');
    const todosCamposValidos = Object.values(campos).every(campo => campo === true);

    if (todosCamposValidos) {
        mensajeErrorGeneral.classList.remove('formulario__mensaje-activo');
    }
};

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
    console.log('Estado de los campos:', campos);

    if (!(campos.cedula && campos.nombre && campos.apellido && campos.lugar && campos.telefono && campos.mail && campos.username && campos.password)) {
        e.preventDefault();
        console.log('Intento de envío del formulario');

        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
    } else {
        console.log('Formulario enviado correctamente.');

        manejarMensajeErrorGeneral();
    }
});