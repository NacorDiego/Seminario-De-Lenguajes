import React, { useEffect, useState } from 'react'
import { BASE_URL } from '../../hooks/useFetch'
import { useNavigate, useParams } from 'react-router-dom'
import './FormAdd.css'

const FormAdd = () => {
  const navigate = useNavigate()
  const [responseText, setResponseText] = useState('')
  const [errorType, setErrorType] = useState('')
  const [text, setText] = useState('')
  const { path } = useParams()

  const handleSubmit = async event => {
    event.preventDefault()
    const nuevoNombre = event.target[0].value

    if (!nuevoNombre) {
      setResponseText('El nombre no puede estar vacio')
      setErrorType('error')
      return
    }

    try {
      const response = await fetch(`${BASE_URL}${path}`, {
        method: 'POST',
        body: JSON.stringify({ nombre: nuevoNombre }),
      })
      const dataJson = await response.json()
      const message = dataJson.message
      setResponseText(message)
      setErrorType('success')
    } catch (error) {
      setResponseText(`Error al agregar ${path}`)
      setErrorType('error')
    }
  }

  const handleChange = event => {
    setText(event.target.value)
  }

  useEffect(() => {
    if (errorType === 'success') {
      //No puedo setear navigate en la linea 32 porque al setear un estado nuevo
      //Tarda unos segundos en setearse y al navegar las variables son null
      navigate(`/${path}`, { state: { errorType, responseText }, replace: false })
    }
  }, [errorType])

  return (
    <div className="contenedor-FormAdd">
      <h2 className="contenedor-FormAdd__titulo">{`Agregar ${
        path === 'generos' ? 'nuevo genero' : 'nueva plataforma'
      }`}</h2>
      <hr />
      <form className="contenedor-FormAdd__formulario" onSubmit={handleSubmit}>
        <input className="formulario__input" type="text" value={text} onChange={handleChange} />
        <button className="formulario__btn" type="submit">
          Agregar
        </button>
      </form>
      {responseText && <div className={`alert ${errorType}`}>{responseText}</div>}
    </div>
  )
}

export default FormAdd
