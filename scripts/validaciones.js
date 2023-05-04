const validacion = () => {
     validacionNombre()
     validacionImg()
     validacionDropdown('#plataforma','error-plataforma')
     validacionDropdown('#genero','error-genero')
     validacionLenght('#descripcion','error-descrip',255)
     validacionLenght('#url','error-url',80)
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


  const validacionDropdown = (idSelector,idError) => {
    const getInputValue = document.getElementById('form-principal').querySelector(idSelector).value;
    if (!getInputValue){
        document.getElementById(idError).innerHTML = 'Campo requerido.'
        return false
    } else {
        document.getElementById(idError).innerHTML = ''
        return true
    }
  }


  const validacionLenght = (idInput, idError, length) => {
    const getInputValue = document.getElementById('form-principal').querySelector(idInput).value;
    console.log('getInputValue.length',getInputValue.length)
    if (getInputValue.length > length){
        document.getElementById(idError).innerHTML = `No debe superar ${length} caracteres.`
        return false
    } else {
        document.getElementById(idError).innerHTML = ''
        return true
    }
  }