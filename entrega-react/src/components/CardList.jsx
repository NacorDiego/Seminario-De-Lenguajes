import '../pages/dashboard/DashboardPage.css'

const CardList = ({ results }) => {
  return (
    <>
      <div className="videojuegos-contenedor">
        <ul className="videojuegos-lista">
          {results.map(juego => {
            return (
              <li className="juego" key={juego.id}>
                <a href={juego.url} target="_blank" rel="noreferrer">
                  <div className="card">
                    <img
                      className="imagen-juego"
                      //Nosotros tenemos la URL encodedada en base64 en nuestra DB y aca la decomeamos
                      //Estoy usando un ternario para ver si la URL ya viene con https o no por si algunos juegos ya viene pre-cargados con imagenes https
                      src={
                        juego.imagen.includes('https')
                          ? juego.imagen
                          : `data:image/jpeg;base64,${juego.imagen}`
                      }
                      alt="juego"
                    />
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
