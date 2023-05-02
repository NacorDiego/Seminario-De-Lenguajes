const validacion = () => {
    const bNombre = validacionNombre()
    const bImg = validacionImg()
    const bPlataforma = validacionPlataforma()
    const bDesc = validacionLenght('#descripcion','error-descrip',255)
    const bUrl = validacionLenght('#url','error-url',80)

    if(bNombre && bImg && bPlataforma && bDesc && bUrl){
        return true
    } else {
        return false
    }
  }

  const validacionNombre = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#nombre').value;

    if (getInputValue === '') {
        document.getElementById('error-nombre').innerHTML = 'Campo requerido.'
        return false
    } else {
        document.getElementById('error-nombre').innerHTML = ''
        return true
    }
  }

  const validacionImg = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#img-juego').value;

    const getFinalExtension = getInputValue.substring(getInputValue.indexOf('.') + 1).trim(); // trim() elimina los espacios que rodean el texto.

    if(getInputValue !== '' && (getFinalExtension === 'jpg' || getFinalExtension === 'png' || getFinalExtension === 'jpeg')) {
        document.getElementById('info-img').innerHTML = ''
        return true
    } else {
        document.getElementById('error-img').innerHTML = 'Extension no soportada'
        return false
    }
  }


  const validacionPlataforma = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#plataforma').value;

    if (!getInputValue){
        document.getElementById('error-plataforma').innerHTML = 'Campo requerido.'
        return false
    } else {
        document.getElementById('error-plataforma').innerHTML = ''
        return true
    }
  }


  const validacionLenght = (idInput, idError, lenght) => {
    const getInputValue = document.getElementById('form-principal').querySelector(idInput).value;

    if (getInputValue.length > lenght){
        document.getElementById(idError).innerHTML = `No debe superar ${lenght} caracteres.`
        return false
    } else {
        document.getElementById(idError).innerHTML = ''
        return true
    }
  }