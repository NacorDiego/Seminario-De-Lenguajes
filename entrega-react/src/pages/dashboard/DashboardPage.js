import { useEffect, useState } from 'react'
import HeaderComponent from '../../components/HeaderComponent'
// Estilos
import './estilos.css'

const DashboardPage = () => {
  const [data, setData] = useState(null)

  useEffect(() => {
    const fetchData = async () => {
      try {
        await fetch('http://localhost:8000/juegos', {
          method: 'GET',
        })
          .then(response => response.json())
          .then(data => {
            console.log(data)
          })
          .catch(error => {
            console.error('Error:', error)
          })
      } catch (error) {
        console.log('Error al obtener los datos:', error)
      }
    }
    fetchData()
  }, [])
  console.log('data', data)

  return (
    <>
      <HeaderComponent />
      <main className="contenedor">
        <div className="contenedor100">
          <form className="formulario" action="index.php" method="GET">
            <div className="campo">
              <label className="campo-label" htmlFor="nombre">
                Nombre
              </label>
              <input className="campo-input" name="nombre" id="nombre" type="text"></input>
            </div>
            <div className="campo">
              <label className="campo-label" htmlFor="genero">
                Genero
              </label>
              <select className="campo-input" name="genero" id="genero">
                <option value="">Seleccionar...</option>
              </select>
            </div>
            <div className="campo">
              <label className="campo-label" htmlFor="plataforma">
                Plataforma
              </label>
              <select className="campo-input" name="plataforma" id="plataforma">
                <option value="" selected>
                  Seleccionar...
                </option>
              </select>
            </div>
            <div className="campo">
              <label className="campo-label" htmlFor="ordenar">
                Ordenar por nombre
              </label>
              <select className="campo-input" name="ordenar" id="ordenar">
                <option value="">Seleccionar...</option>
                <option value="ASC">Ascendente</option>
                <option value="DESC">Descendente</option>
              </select>
            </div>
            <input type="submit" className="boton-filtros" value="Filtrar"></input>
          </form>
        </div>
      </main>
      {/* Aca abajo agregar el footer */}
    </>
  )
}

export default DashboardPage
