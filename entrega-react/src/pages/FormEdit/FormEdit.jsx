import React, { useEffect, useMemo, useState } from 'react'
import useFetch, { BASE_URL } from '../../hooks/useFetch'
import { useNavigate, useParams } from 'react-router-dom'
import './FormEdit.css'

const FormEdit = () => {
  const navigate = useNavigate()
  const [responseText, setResponseText] = useState(null)
  const [errorType, setErrorType] = useState(null)
  const [text, setText] = useState(null)
  const { id, path } = useParams()
  const { results, status } = useFetch(path)

  const handleSubmit = async event => {
    event.preventDefault()
    const nuevoNombre = event.target[0].value

    if (!nuevoNombre) {
      setResponseText('El nombre no puede estar vacio')
      setErrorType('error')
      return
    }

    try {
      const response = await fetch(`${BASE_URL}${path}/${id}`, {
        method: 'PUT',
        body: JSON.stringify({ nombre: nuevoNombre }),
      })
      const dataJson = await response.json()
      const message = dataJson.message
      setResponseText(message)
      setErrorType('success')
    } catch (error) {
      setResponseText(`Error al actualizar ${path}`)
      setErrorType('error')
    }
  }

  const handleChange = event => {
    setText(event.target.value)
  }

  const nameActual = useMemo(() => {
    return status === 'success' && id && results.find(item => item.id === parseInt(id))
  }, [status, id])

  useEffect(() => {
    if (errorType === 'success') {
      //No puedo setear navigate en la linea 32 porque al setear un estado nuevo
      //Tarda unos segundos en setear y al navegar las variables son null
      navigate(`/${path}`, { state: { errorType, responseText }, replace: false })
    }
  }, [errorType])

  return (
    <div className="contenedor-formEdit">
      <h2 className="contenedor-formEdit__titulo">Editar el nombre</h2>
      <hr />
      <form className="contenedor-formEdit__formulario" onSubmit={handleSubmit}>
        <input
          className="formulario__input"
          type="text"
          value={text !== null ? text : nameActual?.nombre || ''}
          onChange={handleChange}
        />
        <button className="formulario__btn" type="submit">
          Actualizar
        </button>
      </form>
      {responseText && <div className={`alert ${errorType}`}>{responseText}</div>}
    </div>
  )
}

export default FormEdit
