const validacion = () => {
    const bNombre = validacionNombre()
    const bImg = validacionImg()
    const bPlataforma = validacionSelectores('#plataforma','error-plataforma','plataforma')
    const bGenero = validacionSelectores('#genero','error-genero','genero')
    const bDesc = validacionLenght('#descripcion','error-descrip',255)
    const bUrl = validacionLenght('#url','error-url',80)

    if(bNombre && bImg && bPlataforma && bGenero && bDesc && bUrl){
        return true
    } else {
        return false
    }
  }

  const validacionNombre = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#nombre').value;

    if (getInputValue === '') {
        document.getElementById('error-nombre').innerHTML = 'El campo nombre es requerido.'
        return false
    } else {
        document.getElementById('error-nombre').innerHTML = ''
        return true
    }
  }

  const validacionImg = () => {
    const getInputValue = document.getElementById('form-principal').querySelector('#img-juego').value;

    console.log('El valor img es: '+getInputValue);

    const getFinalExtension = getInputValue.substring(getInputValue.indexOf('.') + 1).trim(); // trim() elimina los espacios que rodean el texto.

    if(getInputValue){
        if(getInputValue !== '' && (getFinalExtension === 'jpg' || getFinalExtension === 'png' || getFinalExtension === 'jpeg')) {
            document.getElementById('info-img').innerHTML = ''
            return true
        } else {
            document.getElementById('error-img').innerHTML = 'La extensión seleccionada no es válida.'
            return false
        }
    } else{
        document.getElementById('error-img').innerHTML = 'El campo imagen es requerido.'
        return false
    }
  }


  const validacionSelectores = (idInput,idError,nameSelect) => {
    const getInputValue = document.getElementById('form-principal').querySelector(idInput).value;

    if (getInputValue === ''){
        document.getElementById(idError).innerHTML = `Se debe seleccionar ${nameSelect === 'plataforma' ? 'una' : 'un'} ${nameSelect}.`
        return false
    } else {
        document.getElementById(idError).innerHTML = ''
        return true
    }
  }


  const validacionLenght = (idInput, idError, lenght) => {
    const getInputValue = document.getElementById('form-principal').querySelector(idInput).value;

    if (getInputValue.length > lenght){
        document.getElementById(idError).innerHTML = `El campo no debe superar los ${lenght} caracteres.`
        return false
    } else {
        document.getElementById(idError).innerHTML = ''
        return true
    }
  }