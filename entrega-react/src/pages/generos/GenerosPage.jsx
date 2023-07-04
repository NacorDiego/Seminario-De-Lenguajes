import React from 'react'
import useFetch from '../../hooks/useFetch'
import { useLocation } from 'react-router-dom'
import '../GenerosPlataformas.css'
import Listado from '../../components/Listado/Listado'

const GenerosPage = () => {
  const location = useLocation()
  const { results, status } = useFetch('generos')
  const { errorType, responseText } = location.state || {}

  return (
    <main className="contenedor">
      <div className="contenedorListado">
        <h1>Géneros</h1>
        <hr />
        {status === 'loading' ? (
          <p>Cargando..</p>
        ) : status === 'success' ? (
          <Listado path="generos" results={results} />
        ) : (
          status === 'error' && <p>Error al obtener los datos</p>
        )}
      </div>
      {errorType && <div className={`alert ${errorType}`}>{responseText}</div>}
    </main>
  )
}

export default GenerosPage
