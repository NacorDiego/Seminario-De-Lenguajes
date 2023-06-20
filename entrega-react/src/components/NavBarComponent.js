import React from 'react'
import { Link } from 'react-router-dom'
//Estilos
import './styles.css'

const NavBarComponent = () => {
  return (
    <nav>
      <ul className="navbar-lista">
        <li>
          <Link to="/">Inicio</Link>
        </li>
        {/* <hr className="separador" />
        <li>
          <Link to="/">Listado de Generos</Link>
        </li>
        <hr className="separador" />
        <li>
          <Link to="/">Listado de Plataformas</Link>
        </li> */}
      </ul>
    </nav>
  )
}

export default NavBarComponent
