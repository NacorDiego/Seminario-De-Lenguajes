import '../pages/dashboard/estilos.css'
import './estilos.css'

const CardList = ({ results }) => {
  return (
    <>
      <div className="videojuegos-contenedor">
        <ul className="videojuegos-lista">
          {results.map((juego, index) => {
            return (
              <li className="juego" key={juego.nombrejuego + index}>
                <a href={juego.url} target="_blank" rel="noreferrer">
                  <div className="card">
                    <img className="imagen-juego" src={juego.imagen} alt="juego"></img>
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
        </ul>
      </div>
    </>
  )
}

export default CardList
