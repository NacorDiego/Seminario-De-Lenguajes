import { useCallback, useState } from 'react'
import useFetch from '../../hooks/useFetch'
// Componentes
import CardList from '../../components/CardList'
import Form from '../../components/Form'
// Estilos
import './estilos.css'

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
        {status === 'loading' ? (
          <p>Cargando...</p>
        ) : status === 'success' ? (
          <CardList results={results} />
        ) : (
          status === 'error' && <p>Error al obtener los datos</p>
        )}
      </main>
    </>
  )
}

export default DashboardPage
