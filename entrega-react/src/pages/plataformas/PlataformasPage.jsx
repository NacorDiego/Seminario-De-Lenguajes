import '../GenerosPlataformas.css'
import Listado from '../../components/Listado/Listado'
import useFetch from '../../hooks/useFetch'
import { useLocation } from 'react-router-dom'

const PlataformasPage = () => {
  const location = useLocation()
  const { results, status } = useFetch('plataformas')
  const { errorType, responseText } = location.state || {}

  return (
    <main className="contenedor">
      <div className="contenedorListado">
        <h1>Plataformas</h1>
        <hr />
        {status === 'loading' ? (
          <p>Cargando..</p>
        ) : status === 'success' ? (
          <Listado path="plataformas" results={results} />
        ) : (
          status === 'error' && <p>Error al obtener los datos</p>
        )}
      </div>
      {errorType && <div className={`alert ${errorType}`}>{responseText}</div>}
    </main>
  )
}

export default PlataformasPage
