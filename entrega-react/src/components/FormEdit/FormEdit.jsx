import React, { useMemo, useState } from 'react'
import useFetch from '../../hooks/useFetch'
import { useParams } from 'react-router-dom'
import useUpdate from '../../hooks/useUpdate'
import './FormEdit.css'

const FormEdit = () => {
  const [text, setText] = useState(null)
  const [dataJson, setDataJson] = useState(undefined)
  const { id } = useParams()
  const { results, status } = useFetch('generos')

  const handleSubmit = async event => {
    event.preventDefault()
    const nombre = event.target[0].value
    setDataJson({ nombreGenero: nombre })
  }
  //Aca tendriamos que consumir updateGenero para obtener la respuesta para indicar que todo salio bien
  useUpdate('generos', id, dataJson)

  const handleChange = event => {
    setText(event.target.value)
  }

  const generoActual = useMemo(() => {
    return status === 'success' && id && results.find(item => item.id === parseInt(id))
  }, [status, id])

  return (
    <div className="contenedor">
      <h2 className="contenedor__titulo">Editar el nombre</h2>
      <hr />
      <form className="contenedor__formulario" onSubmit={handleSubmit}>
        <input
          className="formulario__input"
          type="text"
          value={text !== null ? text : generoActual?.nombre || ''}
          onChange={handleChange}
        />
        <button className="formulario__btn" type="submit">
          Actualizar
        </button>
      </form>
    </div>
  )
}

export default FormEdit
