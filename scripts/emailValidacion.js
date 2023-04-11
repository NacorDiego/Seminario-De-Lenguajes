const validacion = () => {
    nombreValidacion()
    imgValidacion()
}

const nombreValidacion = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#nombre').value

    if (getInputValue === '') {
        document.getElementById('error-nombre').innerHTML = 'Campo requerido'
    } else {
        document.getElementById('error-nombre').innerHTML = ''
    }

    console.log('getInputs',getInputValue)
}

const imgValidacion = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#img-juego').value

    const getFinalExtension = getInputValue.substring(getInputValue.indexOf('.') + 1).trim()
    console.log('getFinalExtension',getFinalExtension);
    if(getFinalExtension === 'jpg' || getFinalExtension === 'png') {
        document.getElementById('error-img').innerHTML = ''
    } else {
        document.getElementById('error-img').innerHTML = 'Extension no soportada'
    }
    
    console.log('getInputs',getInputValue)
}

nombreValidacion()