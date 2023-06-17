import useFetch from '../hooks/useFetch'
import '../pages/dashboard/estilos.css'

const CardList = () => {
  const { data, status } = useFetch('juegos')

  return (
    <>
      <div className="videojuegos-contenedor">
        <ul className="videojuegos-lista">
          {status === 'loading' ? (
            <p>Cargando...</p>
          ) : status === 'success' ? (
            <>
              {Object.values(data)
                .flat()
                .map(juego => {
                  return (
                    <li className="juego" key={juego.nombrejuego}>
                      <a href={juego.url} target="_blank" rel="noreferrer">
                        <div className="card">
                          <img className="imagen-juego" src={juego.imagen} alt="cat"></img>
                          <div className="card-contenido">
                            <h4 className="titulo-juego">{juego.nombrejuego}</h4>
                            <ul className="lista-encabezados">
                              <li className="encabezado-juego">
                                <b>Género:</b>
                                {juego.nombregenero}
                              </li>
                              <li className="encabezado-juego">
                                <b>Plataforma:</b>
                                {juego.nombrePlataforma}
                              </li>
                              <li className="encabezado-juego">
                                <b>Descripción:</b>
                                {juego.descripcion}
                              </li>
                            </ul>
                          </div>
                        </div>
                      </a>
                    </li>
                  )
                })}
            </>
          ) : (
            status === 'error' && <>Error</>
          )}
        </ul>
      </div>
    </>
  )
}

export default CardList
