import React from 'react'

const FormEdit = props => {
  const searchParams = new URLSearchParams(props?.location?.search)
  const id = searchParams.get('id')
  const nombre = searchParams.get('nombre')

  const handleSubmit = event => {
    event.preventDefault()
  }

  console.log('nombre', nombre)
  console.log('id', id)

  return (
    <div>
      <h2>Formulario {id}</h2>
      <form onSubmit={handleSubmit}>
        <input type="text" placeholder="Nombre" />
        <button type="submit">Enviar</button>
      </form>
    </div>
  )
}

export default FormEdit
