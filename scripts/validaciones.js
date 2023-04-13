const validacion = () => {
    validacionNombre();
    validacionImg();
    validacionDescripcion();
    validacionPlataforma();
    validacionUrl();
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

const validacionDescripcion = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#descripcion').value;

    document.getElementById('error-descrip').innerHTML= getInputValue.length > 255 ? 'No debe superar 255 caracteres.' : '';
}

const validacionPlataforma = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#plataforma').value;

    document.getElementById('error-plataforma').innerHTML= getInputValue> 0 ? '' : 'Campo requerido.';
}

const validacionUrl = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#url').value;

    document.getElementById('error-url').innerHTML= getInputValue.length > 80 ? 'No debe superar 80 caracteres.' : '';
}

