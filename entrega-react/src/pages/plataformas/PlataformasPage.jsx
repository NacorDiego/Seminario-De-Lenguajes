import '../GenerosPlataformas.css'
import Listado from '../../components/Listado/Listado'
import useFetch from '../../hooks/useFetch'

const PlataformasPage = () => {
  const { results, status } = useFetch('plataformas')

  return (
    <main className="contenedor">
      <div className="contenedorListado">
        <h1>Plataformas</h1>
        <hr />
        {status === 'loading' ? (
          <p>Cargando..</p>
        ) : status === 'success' ? (
          <Listado results={results} />
        ) : (
          status === 'error' && <p>Error al obtener los datos</p>
        )}
      </div>
    </main>
  )
}

export default PlataformasPage
