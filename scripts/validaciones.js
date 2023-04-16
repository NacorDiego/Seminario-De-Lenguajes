const validacion = () => {
    validacionNombre();
    validacionImg();
    validacionPlataforma();
    validacionLenght('#descripcion','error-descrip',255);
    validacionLenght('#url','error-url',80);
}

const validacionNombre = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#nombre').value;

    if (getInputValue === '') {
        document.getElementById('error-nombre').innerHTML = 'Campo requerido.'
    } else {
        document.getElementById('error-nombre').innerHTML = ''
    }
}

const validacionImg = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#img-juego').value;

    const getFinalExtension = getInputValue.substring(getInputValue.indexOf('.') + 1).trim(); // trim() elimina los espacios que rodean el texto.
    const getFileName = getInputValue.substring(getInputValue.lastIndexOf('\\') + 1, getInputValue.lastIndexOf('.'));

    if(getFinalExtension === 'jpg' || getFinalExtension === 'png') {
        document.getElementById('info-img').innerHTML = 'Nombre del archivo: ' + getFileName
    } else {
        document.getElementById('error-img').innerHTML = 'Extension no soportada'
    }
}


const validacionPlataforma = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#plataforma').value;

    document.getElementById('error-plataforma').innerHTML = getInputValue > 0 ? '' : 'Campo requerido.';
}


const validacionLenght = (idInput, idError, lenght) => {
    const getInputValue = document.getElementById('form-principal').querySelector(idInput).value;
    
    document.getElementById(idError).innerHTML = getInputValue.length > lenght ? `No debe superar ${lenght} caracteres.` : '';
}

