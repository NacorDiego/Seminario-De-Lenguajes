import { useCallback, useState } from 'react'
import useFetch from '../../hooks/useFetch'
// Componentes
import CardList from '../../components/CardList'
import Form from '../../components/FormFilter'
// Estilos
import './DashboardPage.css'

const DashboardPage = () => {
  const [formData, setFormData] = useState({})
  const { results, status } = useFetch('juegos', formData)

  const handleFormData = useCallback(data => {
    setFormData(data)
  }, [])

  const { results: plataformas } = useFetch('plataformas')
  const { results: generos } = useFetch('generos')

  return (
    <>
      <main className="contenedor">
        <div className="contenedor100">
          <Form plataformas={plataformas} generos={generos} handleFormData={handleFormData} />
        </div>
        <div className="contenedorData">
          <h1>Listado de juegos</h1>
          <hr />
          {status === 'loading' ? (
            <p>Cargando...</p>
          ) : status === 'success' ? (
            <CardList results={results} />
          ) : (
            status === 'error' && <p>Error al obtener los datos</p>
          )}
        </div>
      </main>
    </>
  )
}

export default DashboardPage
